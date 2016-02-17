
function prepareForChange(obj)
{
  $(obj).parent().parent().find('.title').hide();
  $(obj).parent().parent().find('.change-title').show();
}

$(document).ready(function(){
  $('.change-task').click(function(){
    prepareForChange(this);
  });

  $('.cancel-change').click(function(){
    document.location.reload(false);
    return false;
  });
});