<p align="left"><a href="https://laravel.com" target="_blank"><img src="https://github.com/kalesh13/zerodrop/blob/main/public/images/screenshots/logo.png?raw=true" width="200"></a></p>
<br/>

## About this project

Zerodrop, was an educational institution providing short term career oriented courses, something similar to bootcamps in the west. They approached me in 2018 to build a web platform for their institution.

Since the institution is longer functioning, I've obtained permission to use it in my portfolio. This repo will give you an idea of my backend and frontend coding style, design and architectural decisions I've taken during the development.

## Work

The project requirements were simple to start with. Zerodrop needed a website where potential students can get to know the institution, the courses they offered and a contact form. They also needed a backend dashboard which allows administrators to perform CRUD operations on courses.

### Dependencies

The application is built on top of Laravel and VueJs for backend and frontend respectively.

To make my development easier, I've developed some open source packages and two of these are used in this project.

- **[Zauth](https://github.com/kalesh13/z-auth)** - This is a token based authentication library I have created for Laravel. 

  Passport was too heavy for my use cases and there was no Sanctum back then. Zauth allows me to create role based user accounts, multiple API clients, and a common guard for both web and API requests. [Refer the repository.](https://github.com/kalesh13/z-auth)

- **[Vuer](https://github.com/rheas-io/vuer)** - This is a collection of helper files (boilerplates) for VueJs 2. The package contains classes for API requests and other common tasks. [Refer the repository.](https://github.com/rheas-io/vuer)

### Screenshots

[home]: https://github.com/kalesh13/zerodrop/blob/main/public/images/screenshots/home.png?raw=true
[courses]: https://github.com/kalesh13/zerodrop/blob/main/public/images/screenshots/courses-in-home.png?raw=true
[course]: https://github.com/kalesh13/zerodrop/blob/main/public/images/screenshots/course.png?raw=true
[admin]: https://github.com/kalesh13/zerodrop/blob/main/public/images/screenshots/admin.png?raw=true

#### Home page

The landing page consists of a carousel, a featured course section, a courses section, and a contact form.

Carousel and contact form is loaded via blade template, and all other sections are rendered using VueJs components.

![Zerodrop landing page][home]

#### Courses section on the landing page

A dynamically loaded section showing four courses using VueJs components. [Refer component code.](https://github.com/kalesh13/zerodrop/blob/main/resources/js/pages/home/courses.vue)

![Courses section][courses]

#### A single course page

This page shows the details of a single course and is fully rendered using Laravel Blade ie there is no VueJs route for this page.

![Course page][course]

#### Administrator dashboard

Administrator dashboard is a VueJs SPA which allows updating most sections of the frontend like selecting the featured course to show on the frontend, updating descriptions that are displayed on each section, adding a map to contact page, updating contact address, updating social media links, updating logo etc.

> Dashboard also allows updating SEO meta tags of each pages and courses for better SEO.

![Administrator dashboard][admin]

## Remarks

The project was initially built using Laravel 5.6 and VueJs 2. Recently I updated it to Laravel 8 so that clients get to evaluate on my current experience.

**Rewrite was mainly on the API and VueJs components only. Ignore the SASS and HTML structure for now. Those were written in 2018 when I was a beginner with no experience on SASS.**

**If time permits, I'll update it to reflect my current experience.**