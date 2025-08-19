function copyToClipboard() {
    var copyText = document.getElementById("copy-link");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
    return false;
}

function CopyLink(){
    //var link = $(this).attr("data-link");
    new ClipboardJS('.copy-link', {
        container: document.getElementById('minhchungModal')
    });

}
