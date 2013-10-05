 function displayModal() {
    var html = "./path/to/modalFile.html";

    var div= $('#modal'); //the empty container div in your doc for the modal dialog
    feedback.click(function() {
        div.dialog({position: {my: 'right top', at:'center center', of: window}}).load(html); 
        return false; //prevent the page from navigating
    });
  }

function validatePassword() {
    $(document).ready(function() {
        $('#pw2').hide();
        $("#pw1").keyup(function(event) {
            var textBox = document.getElementById("pw1");
            var count = textBox.value.length;

            if (count > 5) {
                $('#pw2').show();
                $('#pw2').css('border', '1px solid #FF0000');
                $('#pw1').css('border', '1px solid #00FF00');
            } else {
                $('#pw2').hide();
                $('#pw1').css('border', '1px solid #FF0000');
            }
        });
        $("#pw2").keyup(function(event) {
            var textBox1 = document.getElementById("pw1");
            var textBox2 = document.getElementById("pw2");


            if (textBox1.value == textBox2.value) {
                $('#pw2').css('border', '1px solid #00FF00');
            } else {
                $('#pw2').css('border', '1px solid #FF0000');
            }
        });
    });
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function validateEmail(email) {
    email = email.val();
    if (IsEmail(email) == false) {
       email.addClass("error");
       error += "\n     -  Invalid Email Address";
    } else {
       email.removeClass("error")
	}
}


