jQuery(document).ready(function(){

  jQuery('[data-remote="true"]').click(function(e){
    e.preventDefault();
    console.log(jQuery(jQuery(this).data("target")+' .modal-body'));
    console.log(jQuery(this).attr("href"));
    jQuery(jQuery(this).data("target")+' .modal-body').load(jQuery(this).attr("href"));
  });
});