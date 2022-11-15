
$(document).ready(function(){

    var RequestData = {
        key: '6937631',
        txnid: '8764567323',
        hash: 'defdfaadgerhetiwerer',
        amount: 2500,
        firstname: 'Jaysinh',
        email: 'dummyemail@dummy.com',
        phone: '6111111111',
        productinfo: 'Bag',
        surl : base_url+'success/success_method',
        furl: base_url+'success/fail_method',
        mode:'dropout'// non-mandatory for Customized Response Handling
    }

    var Handler = {

        responseHandler: function(BOLT){

            // your payment response Code goes here, BOLT is the response object

        },
        catchException: function(BOLT){

            // the code you use to handle the integration errors goes here

            console.log(BOLT);
        }
    }

    $(document).on('click', '#pay_now', function(){
        bolt.launch( RequestData , Handler );
    });



});




