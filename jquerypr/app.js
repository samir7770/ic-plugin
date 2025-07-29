// jQuery(document).ready(function($) {
//     $('#change-title').click(function() {
//         $('#title').text("New Title")
//     })
// })


// jQuery(document).ready(function($){
//     $('#showName').click(function(){
//         $('#output').text('Your output: ' + $("#nameInput").val())
//     })
// })

// jQuery(document).ready(function($){
//     $('#toggleBox').click(function(){
//         $('#box').slideToggle()
//     })
// })

// jQuery(document).ready(function($){
//     $('#addClassBtn').click(function(){
//         $('#colorBox').addClass('red')
//     })

//     $('#removeClassBtn').click(function(){
//         $('#colorBox').removeClass('red')
//     })
// })


// // ===========================
// // ===========================


// jQuery(document).ready(function($){
    
//     // Show Greet Box
//     $('#greetBtn').click(function(){
//         let inputText = $('#nameInput').val();
//         $('#greetingBox').slideDown();
//         $('#greetingText').text('Hello, '+ inputText + '! Welcome to jQuery learning.');
//     })

//     $('#hideBoxBtn').click(function(){
//         $('#greetingBox').slideUp();
//     })

//     $('#changeColorBtn').click(function(){
//         $('#greetingBox').toggleClass('greetingBoxBlue');
//     })


// })



// Simple validation

// jQuery(document).ready(function($) {
//    $('#simpleForm').submit(function(e) {
//        e.preventDefault(); // Prevent the default form submission
       
       
//         let name = $('#userName').val();
//         let email = $('#userEmail').val();

//         if (name === '' || email === '') {
//             $('#formMessage').text('Please fill in all fields.').css('color', 'red');
//         }else if(email === '' || !email.includes('@')) {
//             $('#formMessage').text('Please input valid input').css('color', 'red');
//         }else{
//             $('#formMessage').text('Form submitted successfully!').css('color', 'green');
//             // Here you can add code to send the data to the server if needed
//             console.log('Name:', name, 'Email:', email);
//         }

//    })
// })



// Comment Form

// jQuery(document).ready(function($) {
//     $('#userComment').keyup(function() {
//         let comment = $(this).val();
//         $('#charCount').text(comment.length + '/100')
//     })
//    $('#simpleForm').submit(function(e) {
//        e.preventDefault(); // Prevent the default form submission

//         let comment = $('#userComment').val();

//         if( comment === '') {
//             $('#commentError').text('Comment cannot be empty.').css('color', 'red');
//         }else if(comment.length > 100) {
//             $('#commentError').text('Comment too long.').css('color', 'red');
//         }
//         else {
//             $('#commentSuccess').text('Comment submitted successfully!').css('color', 'green');
//         }

//    })
// })



// AJAX Started 


jQuery(document).ready(function($) {
    $('#ajaxForm').submit(function(e) {
        e.preventDefault();
        console.log('Form submit event triggered');
        let name = $('#name').val();
        let email = $('#email').val();

        $('#loading').show();
        $('#submitBtn').attr('disabled', true);

        $.ajax({
            url: ajax_object.ajax_url,
            type:'POST',
            data:{
                action: 'ajax_form_submit',
                name: name,
                email: email
            }, 
            success: function(response) {
                if(response.success){
                    $('#ajaxResponse').html('<p style="color: green;">' + response.message + '</p>');
                }else {
                    $('#ajaxResponse').html('<p style="color: red;">' + response.message + '</p>');
                }
            },
             complete: function() {
                // Hide loader and re-enable button after request finishes
                $('#loading').hide();
                $('#submitBtn').attr('disabled', false);
            }
        });
    })
})


