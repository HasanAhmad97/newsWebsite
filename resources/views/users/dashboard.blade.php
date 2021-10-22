@extends('homeTest')
@section('content')

<div class="container">

    <p>blank page</p>
</div>

@endsection
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js"></script>
<script>
    // Initialize Firebase
    var firebaseConfig = {
    apiKey: "AIzaSyCZccaw6Ug5FlPV_8EX1rMMhLr9p3XFCLU",
    authDomain: "hasan-bc13b.firebaseapp.com",
    projectId: "hasan-bc13b",
    storageBucket: "hasan-bc13b.appspot.com",
    messagingSenderId: "505058029433",
    appId: "1:505058029433:web:921dc13e36779a6c8f89a8",
    measurementId: "G-7GR7TV82FC"
  };


    if (!firebase.apps.length) {
        firebase.initializeApp(firebaseConfig);
    }
    const  messaging = firebase.messaging();
    messaging.onMessage(function(payload) {
        toastr.options = { onclick: function () {
                window.location=payload.notification.click_action ;
            },
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "showDuration": "40000",
            "hideDuration": "1500",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "progressBar": true,};
        toastr.success(payload.notification.title, payload.notification.body);
        var sound = document.getElementById("PlAyAuDiO");
        sound.play();

    });
<script>
@endpush