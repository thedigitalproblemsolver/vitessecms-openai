var promptForm = {
    init: function () {
        this.attach('CHATGPTBASEAGENTS', 'chatgptagent');
        this.attach('CHATGPTBASEPROMPTS', 'chatgptprompt');
        document.forms.promptForm.setAttribute('data-successFunction', 'promptForm.fillElementWithResponse(response)');
    },
    fillElementWithResponse: function (response) {
        var HTMLstring = response.content;
        window.top.$('#' + response.target).summernote('pasteHTML', HTMLstring);
        window.top.document.getElementsByClassName('modal-backdrop')[0].remove();
        window.top.document.getElementsByTagName('body')[0].className = 'admin';
        window.top.document.getElementById('modal').remove();
    },
    attach: function (selectId, targetId) {
        document.getElementById(selectId).addEventListener('change', function () {
            document.getElementById(targetId).value = this.value;
        });
    }
};

inits.push(promptForm);