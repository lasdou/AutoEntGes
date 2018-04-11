jQuery(document).ready(function(){

  jQuery('[data-remote="true"]').click(function(e){
    e.preventDefault();

    var html_wait = '<div class="modal-header"><h5 class="modal-title" id="remoteModalTitle">Chargement</h5></div><div class="modal-body"><i class="fas fa-spinner fa-pulse"></i> Veuillez-Patienter</div>';

    jQuery(jQuery(this).data("target")+' .modal-content').html(html_wait);
    jQuery(jQuery(this).data("target")+' .modal-content').load(jQuery(this).attr("href"));
  });
});