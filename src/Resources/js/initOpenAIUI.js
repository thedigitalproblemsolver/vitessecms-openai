var initOpenAIUI = function () {
    let itemId = document.location.pathname.split('/').reverse()[0];

    for (const element of document.getElementsByClassName('editor')) {
        let span = document.createElement('span');
        span.innerHTML = '<a class="fa fa-comments-o openmodal" href="admin/openai/adminchatgpt/promptform/' + itemId + '/' + element.id + '" target="_blank"></a>';
        span.className = 'input-group-prepend input-group-text';
        element.before(span);
    }
};

inits.push(initOpenAIUI);