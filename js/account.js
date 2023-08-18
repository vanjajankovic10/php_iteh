//DELETE ACCOUNT
$('#btnDeleteAcc').click(function(){
    let id = document.getElementsByName('id')[0].value;
    console.log(id);

    req=$.ajax({
        url: 'requestHandler/user/delete.php',
        type: 'post',
        data: {'id':id}
    })

    req.done(function(res,textStatus,jqXHR){
        if(res=="Deleted"){
            alert("Successfully deleted account");
            location.href="logout.php";
        }
        else{
            alert("Error occured while deleting account");
            console.log(res)
        }
    });
    
    req.fail(function(jqXHR,textStatus,errorThrown){
        console.log('Error '+textStatus, errorThrown);
    })
});



//UPDATE ACCOUNT
$('#registrationAccForm').submit(function(){
    event.preventDefault();

    const $form = $(this);
    const $input = $form.find('input');

    const data=$form.serialize();

    console.log(data);

    $input.prop('disabled',true);

    req=$.ajax({
        url: 'requestHandler/user/update.php',
        type:'post',
        data: data
    });


    $input.prop('disabled',false);
    req.done(function(res,textStatus,jqXHR){
        if(res=="Edited"){
            alert("Successfully edited account");
            location.href="account.php";
        }else{
            alert("Error occured while editing account")

        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Error '+textStatus, errorThrown)
    });
});