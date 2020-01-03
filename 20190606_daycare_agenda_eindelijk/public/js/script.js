(function() {
  var demo, fixedTable;

  fixedTable = function(el) {
    var $body, $header, $sidebar;
    $body = $(el).find('.fixedTable-body');
    $sidebar = $(el).find('.fixedTable-sidebar table');
    $header = $(el).find('.fixedTable-header table');
    return $($body).scroll(function() {
      $($sidebar).css('margin-top', -$($body).scrollTop());
      return $($header).css('margin-left', -$($body).scrollLeft());
    });
  };

  demo = new fixedTable($('#demo'));

}).call(this);


$(document).ready(function(){
   console.log("hii");





  $('.fixedTable-header th').on('click',function(){
    if($('.overview').css('display') == 'none')
    {
      $('.overview').css('display','block');
      $('[name=name]').val($(this).text());
      var dt = new Date($.now());
      var date = dt.getFullYear() + "/" + dt.getMonth()  + "/" + dt.getDay();
      var time = dt.getHours() + ":" + dt.getMinutes();
       $('[name=date]').val(date);
      $('[name=time]').val(time);
    }else{
      $('.overview').css('display','none');
    }       
  });

  $('.opslaanBericht').on('click',function(){


    if($('.overview').css('display') == 'none')
    {
      $('.overview').css('display','block');
      $('[name=name]').val($(this).text());
      var dt = new Date($.now());
      var date = dt.getFullYear() + "/" + dt.getMonth()  + "/" + dt.getDay();
      var time = dt.getHours() + ":" + dt.getMinutes();
       $('[name=date]').val(date);
      $('[name=time]').val(time);
    }else{
      $('.overview').css('display','none');
    }       
  });

});