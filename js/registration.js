$('#registrationForm').submit(function(){
    event.preventDefault();
    const $form=$(this);
    const $input = $form.find('input');
    const data = $form.serialize();
    console.log(data);

    $input.prop('disabled', true);
    req=$.ajax({
        url:'requestHandler/user/add.php',
        type:'post',
        data:data
    });

    $input.prop('disabled', false);
    req.done(function(res,textStatus,jqXHR){
        if(res=="Successful"){
            alert("Successfully created account");
            location.href='index.php';
        }
        else{
            alert("Failed at creating account");
            console.log(res);
        }
    });
    
    req.fail(function(jqXHR,textStatus,errorThrown){
        console.error('Error '+textStatus, errorThrown);
    });

})