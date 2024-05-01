// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getMessaging, getToken } from "firebase/messaging";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDD4GF3fxkwjjcH-ZJsV2TNUJybnDHzxQo",
  authDomain: "marino-ebfa9.firebaseapp.com",
  projectId: "marino-ebfa9",
  storageBucket: "marino-ebfa9.appspot.com",
  messagingSenderId: "286557377805",
  appId: "1:286557377805:web:b879fe69564aeb0a9c8c44",
  measurementId: "G-D7HHEJLY3G"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const messaging = getMessaging(app);


getToken(messaging, { vapidKey: 'BGiSfEUukXteJ2GhZ7bIu18fx8KBtJI-Y9NFXHaOLEu3PEb7H_rjRKO7nUl8b1eOw8GWlQmEoEVrcn-harGfoYQ' }).then((currentToken) => {
  if (currentToken) {
    // Send the token to your server and update the UI if necessary

    console.log(currentToken);
    // ...
  } else {
    // Show permission request UI
    console.log('No registration token available. Request permission to generate one.');
    // ...
  }
}).catch((err) => {
  console.log('An error occurred while retrieving token. ', err);
  // ...
});






