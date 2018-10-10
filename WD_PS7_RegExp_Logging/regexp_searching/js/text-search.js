const REGEXP_PATTERN = /^\/.+\/(?!.*(i{2,})|g{2,}|m{2,}|y{2,})[igmy]{0,4}$/;

// Search text with regular expression
function search() {
    resetErrors('text', 'regexp');

    const text = document.getElementById('text').value;
    const regExpStr = document.getElementById('regexp').value;

    if (text.trim() === '') {
        return printError('text', 'Empty text');
    }

    if (REGEXP_PATTERN.test(regExpStr)) {
        printResult(regExpStr, text);
    } else {
        printError('regexp', 'Invalid regular expression');
    }
}

// Print searching result
function printResult(regExpStr, text) {
    const endPattern = regExpStr.lastIndexOf('/');
    const pattern = regExpStr.substring(1,endPattern);
    const flag = (endPattern < regExpStr.length - 1) ? regExpStr.substring(endPattern + 1) : '';
    const regExp = new RegExp(pattern, flag);

    document.getElementById('output').innerHTML = htmlSpecialChars(text).replace(regExp, '<mark>$&</mark>');
}

// Print error message
function printError(elementId, errMsg) {
    document.getElementById(elementId).classList.add('border_red');
    document.getElementById(elementId + '_err').innerText = errMsg;
}

// Reset errors
function resetErrors() {
    for (let i = arguments.length; i--;) {
        document.getElementById(arguments[i]).classList.remove('border_red');
        document.getElementById(arguments[i] + '_err').innerText = '';
    }
}

// Replace tags on html special chars
function htmlSpecialChars(str) {
    return str.replace(/</g, '&lt;').replace(/>/g, '&gt;');
}