function initRandomDrawButton() {
    setTimeout(function () {
        let contentStudent = document.querySelector("#list-student tbody"),
            randomDrawButton = document.querySelector("#draw button");
        if (!contentStudent.firstElementChild) {
            randomDrawButton.classList.add("desactived");
        } else {
            randomDrawButton.classList.remove("desactived");
        }
    }, 300);
}

initRandomDrawButton();

function refreshViewStudent() {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange', function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let listStudentEl = document.querySelector("#list-student tbody");
            listStudentEl.innerHTML = xhr.responseText;
        }
    });
    xhr.open('POST', 'include/action/ajaxRefreshStudent.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}

function refreshViewSpeeches() {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange', function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let listSpeechesEl = document.querySelector("#list-speeches tbody");
            listSpeechesEl.innerHTML = xhr.responseText;
        }
    });
    xhr.open('POST', 'include/action/ajaxRefreshSpeeches.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}

function saveStudent() {
    let form = document.querySelector("#crew form");
    if (checkDatas(form.firstname, 'le prénom', 'name') && checkDatas(form.lastname, 'le nom', 'name')) {
        let firstname = document.getElementById("firstname").value,
            lastname = document.getElementById("lastname").value;
        let xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                removeAllCheckForm();
                refreshViewStudent();
                initRandomDrawButton();
            }
        });
        xhr.open('POST', 'include/action/ajaxAddStudent.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('firstname=' + firstname + '&lastname=' + lastname);
    }
}

function modifyStudent(id) {
    let form = document.querySelector("#crew form");
    if (checkDatas(form.firstname, 'le prénom', 'name') && checkDatas(form.lastname, 'le nom', 'name')) {
        let firstname = form.firstname.value,
            lastname = form.lastname.value;
        let xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                removeAllCheckForm();
                cancelModifyStudent()
                refreshViewStudent();
                refreshViewSpeeches();
                initRandomDrawButton();
            }
        });
        xhr.open('POST', 'include/action/ajaxUpdateStudent.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('firstname=' + firstname + '&lastname=' + lastname + '&id=' + id);
    }
}

function updateStudent(id, firstname, lastname) {
    let form = document.querySelector("#crew form"),
        testbtnCancel = !!document.getElementById("btn-cancel");
    if (!testbtnCancel) {
        let btnCancel = document.createElement("button");
        btnCancel.textContent = "Annuler";
        btnCancel.setAttribute("id", "btn-cancel");
        btnCancel.setAttribute("onclick", "cancelModifyStudent(); return false;");
        form.appendChild(btnCancel);
    }
        form.save.textContent = "Modifier";
        form.save.setAttribute("onclick", "modifyStudent(" + id + "); return false;");
        form.classList.add("update");
        form.firstname.value = firstname;
        form.lastname.value = lastname;
}

function cancelModifyStudent() {
    let form = document.querySelector("#crew form"),
        btnCancel = document.getElementById("btn-cancel");
    btnCancel.remove();
    form.save.textContent = "Ajouter";
    form.save.setAttribute("onclick", "saveStudent(); return false;");
    form.classList.remove("update");
    form.firstname.value = "";
    form.lastname.value = "";
}

function removeAllCheckForm() {
    let fields = document.querySelectorAll("input"),
        nbFields = fields.length,
        form = document.querySelector("form");
    form.firstElementChild.innerText = "";
    for (let i = 0; i < nbFields; i++) {
        fields[i].value = "";
        fields[i].classList.remove("validated");
        fields[i].classList.remove("error");
    }
}

function removeStudent(id) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange', function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            refreshViewStudent();
            refreshViewSpeeches();
            initRandomDrawButton();
        }
    });
    xhr.open('POST', 'include/action/ajaxRemoveStudent.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send('id=' + id);
}

function checkDatas(el, field, type) {
    let value = el.value,
        regex, error, check = true;
    switch (type) {
        case 'name' :
            if (value.length < 3) {
                error = field + " ne peut contenir moins de 3 caractères";
                check = false;
            } else {
                regex = /[0-9._?!:;,]+/g;
                check = !regex.test(value);
                error = field + " ne peut contenir que des lettres";
            }
            break;
    }
    if (!check) {
        el.classList.add("error");
        el.parentNode.firstElementChild.innerText = error;
    } else {
        el.classList.add("validated");
        el.parentNode.firstElementChild.innerText = "";
    }
    return check;
}

function randomDraw(btn) {
    if (!btn.classList.contains("desactived")) {
        let xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let name = xhr.responseText;
                popup('info', name, 'small');
                refreshViewSpeeches();
                refreshViewStudent();
            }
        });
        xhr.open('POST', 'include/action/ajaxRandomDrawStudent.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send();
    }
}

function popup(type, content, size) {
    let body = document.querySelector('body'),
        cache = document.getElementById("cache"),
        boxWrapper = document.getElementById("box-wrapper"),
        box = document.createElement("div");
    body.classList.add('scrollhidden');
    cache.classList.add("actived");
    boxWrapper.classList.add("open");
    box.setAttribute("id", "box");
    box.classList.add(size, "box");
    boxWrapper.appendChild(box);
    switch (type) {
        case "info" :
            let contentBox = document.createElement("div"),
                close = document.createElement("button");
            contentBox.setAttribute("id", "content");
            box.appendChild(contentBox);
            close.setAttribute("id", "closebox");
            close.classList.add('pointer');
            close.setAttribute("onclick", "closePopup(); return false;");
            box.insertBefore(close, contentBox);
            contentBox.innerText = "Intervention de " + content;
            break;
    }
}

function closePopup() {
    let body = document.querySelector('body'),
        boxwrapper = document.getElementById('box-wrapper'),
        cache = document.getElementById('cache');
    body.classList.remove('scrollhidden');
    boxwrapper.classList.remove('open');
    cache.classList.remove('actived');
    setTimeout(function () {
        boxwrapper.removeChild(document.getElementById("box"));
    }, 250);
}