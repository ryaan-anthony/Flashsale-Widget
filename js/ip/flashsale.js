
function timeLeft(timeleft)
{
    var seconds = timeleft;

    var days = Math.floor(seconds / 86400);
    seconds %= 86400;

    var hours = Math.floor(seconds / 3600);
    seconds %= 3600;

    var minutes = Math.floor(seconds / 60);
    seconds %= 60;

    if(days){
        return days+' days '+hours+' hours';
    } else if(hours){
        return hours+' hours '+minutes+' minutes';
    }
    return minutes+' minutes '+seconds+' seconds';

}


jQuery.noConflict();
jQuery(document).ready(function($){

    setInterval(function(){
        $('.flash-sale').each(function(){
            var expires = $(this).attr('data-expires');
            expires -= 1;
            $(this).attr('data-expires', expires);
            if(expires <= 0){$(this).parent().hide('fast',function(){$(this).remove();});}
            $(this).find('span').html(timeLeft(expires));
        });
    },1000);


});