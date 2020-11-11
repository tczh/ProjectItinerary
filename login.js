function init() {
    gapi.load('auth2', function() {
      /* Ready. Make a call to gapi.auth2.init or some other API */
    });
}

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();

    var email = profile.getEmail();
    var first = profile.getGivenName();
    var last = profile.getFamilyName();

    gapi.auth2.getAuthInstance().disconnect();

    // sign out
    // var auth2 = gapi.auth2.getAuthInstance();
    // auth2.signOut().then(function () {
    //   console.log('User signed out.');
    // });

    // console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    // console.log('Name: ' + profile.getName());
    // console.log('Image URL: ' + profile.getImageUrl());
    // console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    
    // var id_token = googleUser.getAuthResponse().id_token;
    window.location.replace("objects/ProcessLogin.php?google=true&password=&email=" + email + "&first=" + first + "&last=" + last);
  }

// $(document).ready(function() {
//   $('.form-control').on('keyup', function() {
//     let empty = false;

//     $('.form-control').each(function() {
//       empty = $(this).val().length == 0;
//     });

//     if (empty)
//       $('button').attr('disabled', 'disabled');
//     else
//       $('button').attr('disabled', false);
//   });
// });

// $(document).ready(function(){
//   $('button').prop('disabled',true);
//   $('.form-control').keyup(function(){
//       $('button').prop('disabled', this.value == "" ? true : false);     
//   })
// }); 

// $("#emailinput").keyup(function(event) {
//   validateInputs();
// });

// $("#passwordinput").keyup(function(event) {
//   validateInputs();
// });

// function validateInputs(){
//   var disableButton = false;

//   var val1 = $("emailinput").val();
//   var val2 = $("#passwordinput").val();

//   if(val1.length == 0 || val2.length == 0)
//       disableButton = true;

//   $('button').attr('disabled', disableButton);
// }