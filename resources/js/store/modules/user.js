import Vue from 'vue';
import { DataPoster, DataFetcher } from '@rheas/vuer';

const dp = new DataPoster();
const df = new DataFetcher();

/**
 * Returns the profile data saved on the localstorage. Value of user state is initially
 * set to this value.
 *
 * @returns object
 */
const getFromLocalStorage = function() {
    return JSON.parse(localStorage.getItem('profile') || '{}');
};

/**
 * Saves the user profile to the localstorage, so that they can retreived again on
 * page reloads.
 *
 * @param {object} data
 */
const saveToLocalStorage = function(data) {
    localStorage.setItem('profile', JSON.stringify(data));
};

const state = {
    profile: getFromLocalStorage(),
};

const actions = {
    fetchUser: function({ state, commit }, callback) {
        df.fetchData(
            `/api/user/${state.profile.id}`,
            data => {
                commit('setProfileData', data);

                if (typeof callback === 'function') callback(data);
            },
            // The callback has to be called even if profile fetch was a failure, so that the
            // callback is executed no matter what happens with profile fetch.
            error => {
                if (typeof callback === 'function') callback(error);
            },
        );
    },
    updateUser: function({ state, commit }, payload) {
        const dataPoster = payload.dp || dp;

        dataPoster.formPost(
            `/api/user/${state.profile.id}`,
            payload.data,
            () => {
                commit('setProfileData', payload.data);
                if (typeof payload.onSuccess === 'function') payload.onSuccess();
            },
            payload.onError,
            payload.onStart,
            payload.onEnd,
        );
    },
};

const mutations = {
    setProfileData: function(state, data) {
        for (let key in data) {
            Vue.set(state.profile, key, data[key]);
        }
        saveToLocalStorage(state.profile);
    },
    logout: function() {
        saveToLocalStorage({});
    },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
};
