$(document).ready(function(){
    //Check sign up from fields and uniquness
    $("#sign_up_form").submit(function(){
        if($("#sign_up_name").val().trim().length == 0 || $("#sign_up_username").val().trim().length == 0
                || $("#sign_up_pwd").val().trim().length == 0){
            alert("All fields must be filled");
            return false;
        }
        return true;
    });
    //Check if username is already taken
    $("#sign_up_username").keyup(function(){
        $.post("checkUsername.php",
        {
            username: $(this).val()
        },
        function(data, status){
            if (data.trim() === "true") {
		alert("Username " + data + " is already taken.");
            }
        });
    });
    
    //Check if username of password fields are empty
    $("#login_form").submit(function (event) {
        if ($("#email").val().trim().length == 0 || $("#pwd").val().trim().length == 0) {
            alert("Username and Password must be nonempty");
            return false;
        }
        return true;
    });
    //Removing items from sale and table
    $("#itemsForSale button").click(function(){
       $.post("remove_item.php",
       {
           itemID: $(this).val()
       });
       $(this).closest('tr').fadeOut('fast', function(){$(this).remove();});
    });
    //Purchase Item
    $("#purchaseButton").click(function(){
       $.post("purchase_item.php",
       {
           itemID: $(this).val()
       },
       function(data, status){
           if(data.status === 'error' || status === 'error'){
                alert("Error could not complete transaction.\nCheck Sign in Status.");
           }else{
               alert("You have successfully purchased this item");
           }
       });
    });
    //Check all fields in Update Form are filled
    $("#update_form").submit(function(){
        if ($("#name").val().trim().length == 0 || $("#email").val().trim().length == 0 || $("#pwd").val().trim().length == 0) {
            alert("All fields must be nonempty");
            return false;
        }
       return true;
    });
    //Check all fields in add item form are filled
    $("#addItemForm").submit(function(){
        if($("#itemName").val().trim().length == 0 || $("#itemPrice").val().trim().length == 0 || !$.isNumeric($("#itemPrice").val())){
            alert("All fields must be nonempty and price must be numeric");
            return false;
        }
        return true;
    });
});