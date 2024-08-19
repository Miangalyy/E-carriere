$(document).ready(function(){
    $('.sub-btn').click(function(){
        $(this).find('.sub-menu').toggle(500);
        $(this).find('.dropdown').toggleClass('rotate');
    })
  })