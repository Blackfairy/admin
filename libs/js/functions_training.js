function suggestion() {
    $('#train_sug_input').keyup(function (e) {
        var formData = {
            'training_name': $('input[name=title]').val()
        };

        if (formData['training_name'].length >= 1) {
            // process the form
            $.ajax({
                type: 'POST',
                url: 'ajax_training.php',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function (data) {
                //console.log(data);
                $('#result').html(data).fadeIn();
                $('#result li').click(function () {
                    $('#train_sug_input').val($(this).text());
                    $('#result').fadeOut(500);
                });

                $("#train_sug_input").blur(function () {
                    $("#result").fadeOut(500);
                });
            })
            .fail(function () {
                // Handle the failure case if needed
            });
        } else {
            $("#result").hide();
        }

        e.preventDefault();
    });
}

$('#train_sug-form').submit(function (e) {
    var formData = {
        'p_name': $('input[name=title]').val()
    };
    // process the form
    $.ajax({
        type: 'POST',
        url: 'ajax_training.php',
        data: formData,
        dataType: 'json',
        encode: true
    })
    .done(function (data) {
        //console.log(data);
        $('#product_info').html(data).show();
        total();
        $('.datePicker').datepicker('update', new Date());
    })
    .fail(function () {
        // Handle the failure case if needed
    });
    e.preventDefault();
});

  function total() {
    $('#training_info').on('input', 'input', function (e) {
      // Updated the selector to #training_info
      var price = +$('input[name=price]').val() || 0;
      var qty = +$('input[name=quantity]').val() || 0;
      var total = qty * price;
      $('input[name=total]').val(total.toFixed(2));
    });
  }

 $(document).ready(function() {

   //suggetion for finding training names
   suggestion();
   // Callculate total ammont
   total();

   $('.datepicker')
       .datepicker({
           format: 'yyyy-mm-dd',
           todayHighlight: true,
           autoclose: true
       });
 });
