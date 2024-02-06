var promptForm = function () {
    function attach(selectId, targetId) {
        document.getElementById(selectId).addEventListener('change', function () {
            document.getElementById(targetId).value = this.value;
        });
    }

    attach('CHATGPTBASEAGENTS', 'chatgptagent');
    attach('CHATGPTBASEPROMPTS', 'chatgptprompt');
};

inits.push(promptForm);