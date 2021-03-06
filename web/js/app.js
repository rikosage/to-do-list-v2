
function prepareForChange(obj)
{
  $(obj).parent().parent().find('.title').hide();
  $(obj).parent().parent().find('.activate-task button').hide();
  $(obj).parent().parent().find('.task-control').hide();
  $(obj).parent('.comment-container').hide();
  $(obj).parent().parent().find('.change-title').show();
  
}

$(document).ready(function(){
  $('.change-task').click(function(){
    prepareForChange(this);
    return false;
  });

  $('.cancel-change').click(function(){
    document.location.reload(false);
    return false;
  });

  $('.delete-task-button').click(function(){
    if (confirm("You are sure?"))
    {
      return true;
    }
    else
    {
      return false;
    }
  });

  $('.change-status').click(function(){
    var status = $(this).parent().find(".status");
    status.val((status.val()==1) ? 0 : 1);
  });
});