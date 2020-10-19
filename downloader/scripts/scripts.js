var seconds = 3;
$("#download-counter").text(seconds);
var counter = setInterval(function() {
    curr_counter = parseInt($("#download-counter").text());
    --curr_counter;
    if(curr_counter == 0) {
        clearInterval(counter);
        fetchDownloadLink(file_id);
    } else {
        $("#download-counter").text(curr_counter);
    }
}, 1000);
function fetchDownloadLink(file_id)
{
    $.ajax({
        url: project_url + 'fetch_link.php?file_id=' + file_id,
        method: "GET",
        success: function(response) {
            $("#download-counter").remove();
            $(".download-wrapper").html(response);
        }
    });
}