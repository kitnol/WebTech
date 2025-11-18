function editUsername() {
    document.getElementById('username-info').style.display = 'none';
    document.getElementById('username-edit').style.display = '';
}

function cancelUsername() {
    document.getElementById('username-edit').style.display = 'none';
    document.getElementById('username-info').style.display = '';
}
function editEmail() {
    document.getElementById('emailname-info').style.display = 'none';
    document.getElementById('emailname-edit').style.display = '';
}

function cancelEmail() {
    document.getElementById('emailname-edit').style.display = 'none';
    document.getElementById('emailname-info').style.display = '';
}

/* This is for checking the current password before submitting chages -->*/
document.addEventListener("DOMContentLoaded", () => {
    const currentPasswordInput = document.getElementById("current_password");

    currentPasswordInput.addEventListener("blur", function () {
        const password = this.value;

        if (password.length === 0) return;

        fetch("/check-password", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ password: password })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.valid) {
                this.classList.add("input-error");
                showErrorMessage("Current password is incorrect.");
            } else {
                this.classList.remove("input-error");
                clearErrorMessage();
            }
        });
    });
});

function showErrorMessage(msg) {
    let errorBox = document.getElementById("inline-error");

    if (!errorBox) {
        errorBox = document.createElement("div");
        errorBox.id = "inline-error";
        errorBox.className = "alert alert-danger mt-2";
        document.querySelector("#current_password").after(errorBox);
    }

    errorBox.textContent = msg;
}

function clearErrorMessage() {
    let errorBox = document.getElementById("inline-error");
    if (errorBox) errorBox.remove();
}
/* <-- */