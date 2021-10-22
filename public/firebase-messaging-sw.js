/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyCZccaw6Ug5FlPV_8EX1rMMhLr9p3XFCLU",
	authDomain: "hasan-bc13b.firebaseapp.com",
	projectId: "hasan-bc13b",
	storageBucket: "hasan-bc13b.appspot.com",
	messagingSenderId: "505058029433",
	appId: "1:505058029433:web:921dc13e36779a6c8f89a8",
	measurementId: "G-7GR7TV82FC"

});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging2 = firebase.messaging();
messaging2.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});
