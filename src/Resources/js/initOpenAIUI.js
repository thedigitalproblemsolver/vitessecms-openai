var initOpenAIUI = function () {
    for (const element of document.getElementsByClassName('editor')) {
        let span = document.createElement('span');
        span.innerHTML = '<a class="fa fa-comments-o openmodal" href="admin/openai/adminchatgpt/promptform" target="_blank"></a>';
        span.className = 'input-group-prepend input-group-text';
        element.before(span);
    }
};

inits.push(initOpenAIUI);