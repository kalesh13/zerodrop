import { DataPoster } from '@rheas/vuer';

export class PageUpdater extends DataPoster {
    constructor() {
        super();
        this.submissionResponse = { error: false, message: '' };
    }

    /**
     * Posts the given `form_data` to the given api endpoint - `url`. Before initiating
     * the call we will reset the previous submission status.
     * 
     * @param {string} url 
     * @param {object} form_data 
     */
    updatePage(url, form_data) {
        this.submissionResponse = { error: false, message: '' };

        this.formPost(
            url,
            { ...form_data, _method: 'PATCH' },
            () => (this.submissionResponse = { message: 'Data saved successfully.' }),
            this.onError.bind(this),
        );
    }

    /**
     * Updates the submission response with the error report, if any server error has happened.
     * HTTP 422 errors will be ignored. Components can take care of itself. The `submissionResponse`
     * is mainly for the widget with `Publish` button to indicate the POST status.
     */
    onError() {
        this.submissionResponse = {
            error: this.errors.server_error ? true : false,
            message: this.errors.server_error || '',
        };
    }
}
