jQuery(document).ready(function(){

  var html_wait = '<div class="modal-header"><h5 class="modal-title" id="remoteModalTitle">Chargement</h5></div><div class="modal-body"><i class="fas fa-spinner fa-pulse"></i> Veuillez-Patienter</div>';

  jQuery('[data-remote="true"]').click(function(e){
    e.preventDefault();

    jQuery(jQuery(this).data("target")+' .modal-content').html(html_wait);
    jQuery(jQuery(this).data("target")+' .modal-content').load(jQuery(this).attr("href"));
  });

  jQuery(document).on('click', '.modal-content [type="submit"][data-remote="true"]', function(e){
    e.preventDefault();
    var MyForm = jQuery(this).parent().parent();
    var form_container = MyForm.parent();
      $.ajax({
          type: "POST",
          url: MyForm.attr('action'),
          data: MyForm.serialize(), // serializes the form's elements.
          beforeSend: function () {
            form_container.html(html_wait);
          },
          success: function(data)
          {
              form_container.html(data); // show response from the php script.
          }
      });

  });
});