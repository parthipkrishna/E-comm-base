$(function() {
 $("input,textarea").jqBootstrapValidation({
 preventSubmit: true,
 submitError: function($form, event, errors) {
 // additional error messages or events
 },
 submitSuccess: function($form, event) {
 event.preventDefault(); // prevent default submit behaviour
 // get values from FORM
 var name = $("input#user-name").val();
 var lastname = $("input#user-lastname").val();
 var email = $("input#user-email").val();
 var phone = $("input#user-phone").val();
 var subject = $("input#user-subject").val();
 var message = $("textarea#user-message").val();
 var firstName = name; // For Success/Failure Message
 // Check for white space in name for Success/Fail message
 if (firstName.indexOf(' ') >= 0) {
 firstName = name.split(' ').slice(0, -1).join(' ');
 }
 $.get("/sanctum/csrf-cookie").done(function() {
    $.ajax({
        type: "POST",
        url: $("form").attr("action"),
        data: $("form").serialize(),
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(response) {
            alert(response.message);
            window.location.href = response.redirect;
        },
        error: function(xhr) {
            console.log("Error:", xhr.responseText);
            alert("Something went wrong!");
        }
    });
});
