import _ from 'lodash';
window._ = _;

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

/* import Echo from 'laravel-echo';

 window.Pusher = require('pusher-js');

 window.Echo = new Echo({
     broadcaster: 'pusher',
     key: process.env.PUSHER_APP_KEY,
     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
     forceTLS: true
 });*/


/*import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.PUSHER_APP_KEY,
    cluster: import.meta.env.PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true,
});*/

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '12321234234avs',
    cluster: 'mt1',
    wsHost: 'localhost',
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: false,
    encrypted: false,
    disableStats: true,
    enabledTransports: ['ws'],
    //enabledTransports: ['ws', 'wss],
});

window.Pusher = Pusher;
