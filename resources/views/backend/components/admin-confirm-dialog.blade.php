<div id="adminConfirmDialog" hidden role="dialog" aria-modal="true" aria-labelledby="adminConfirmTitle" style="position:fixed;inset:0;z-index:2500;background:rgba(15,23,42,.55);padding:20px;align-items:center;justify-content:center;display:none">
    <div style="background:#fff;border-radius:16px;padding:24px;max-width:500px;width:100%;box-shadow:0 24px 80px rgba(15,23,42,.25)">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px">
            <h3 id="adminConfirmTitle" style="font-size:18px;font-weight:700;margin:0 0 14px;color:#343a40">Confirm action</h3>
            <button type="button" id="adminConfirmClose" aria-label="Close" style="border:0;background:transparent;color:#777;font-size:22px;line-height:1;cursor:pointer">&times;</button>
        </div>
        <p id="adminConfirmMessage" class="text-muted mb-4">Are you sure you want to continue?</p>
        <div class="d-flex justify-content-end" style="gap:8px">
            <button type="button" class="btn btn-light" id="adminConfirmCancel">Cancel</button>
            <button type="button" class="btn btn-danger" id="adminConfirmProceed">Yes</button>
        </div>
    </div>
</div>
<script>
(function () {
    const dialog = document.getElementById('adminConfirmDialog');
    const title = document.getElementById('adminConfirmTitle');
    const message = document.getElementById('adminConfirmMessage');
    const cancelButton = document.getElementById('adminConfirmCancel');
    const closeButton = document.getElementById('adminConfirmClose');
    const proceedButton = document.getElementById('adminConfirmProceed');
    if (!dialog || !title || !message || !cancelButton || !closeButton || !proceedButton) return;

    let pendingForm = null;

    function closeDialog() {
        dialog.hidden = true;
        dialog.style.display = 'none';
        pendingForm = null;
        proceedButton.disabled = false;
        proceedButton.textContent = 'Yes';
        cancelButton.disabled = false;
        closeButton.disabled = false;
    }

    function confirmationFor(form) {
        const fieldName = form.getAttribute('data-admin-confirm-field');
        if (!fieldName) {
            return {
                title: form.getAttribute('data-admin-confirm-title') || 'Confirm action',
                message: form.getAttribute('data-admin-confirm') || 'Are you sure you want to continue?'
            };
        }

        const field = form.elements.namedItem(fieldName);
        const value = field && typeof field.value === 'string' ? field.value : '';
        const current = form.getAttribute('data-admin-confirm-current');
        if (current !== null && value === current) return null;

        if (value === 'approved') {
            return {
                title: 'Approve this member?',
                message: form.getAttribute('data-admin-confirm-approve') || 'Approve this member account? The member will get access to the dashboard.'
            };
        }
        if (value === 'rejected') {
            return {
                title: 'Reject this application?',
                message: form.getAttribute('data-admin-confirm-reject') || 'Reject this member application?'
            };
        }
        return {
            title: 'Update member status?',
            message: form.getAttribute('data-admin-confirm-default') || 'Save this member account status change?'
        };
    }

    document.addEventListener('submit', function (event) {
        const form = event.target;
        if (!(form instanceof HTMLFormElement) || !form.matches('form[data-admin-confirm], form[data-admin-confirm-field]')) return;

        const confirmation = confirmationFor(form);
        // No confirmation is needed when the selected member status has not changed.
        if (!confirmation) return;

        event.preventDefault();
        pendingForm = form;
        title.textContent = confirmation.title;
        message.textContent = confirmation.message;
        dialog.hidden = false;
        dialog.style.display = 'flex';
        proceedButton.focus();
    }, true);

    function cancelPending() {
        closeDialog();
    }

    cancelButton.addEventListener('click', cancelPending);
    closeButton.addEventListener('click', cancelPending);
    proceedButton.addEventListener('click', function () {
        const form = pendingForm;
        if (!form || !form.isConnected) {
            closeDialog();
            return;
        }

        proceedButton.disabled = true;
        proceedButton.textContent = 'Please wait...';
        cancelButton.disabled = true;
        closeButton.disabled = true;

        // Submit the original form without re-triggering this confirmation listener.
        HTMLFormElement.prototype.submit.call(form);
    });

    dialog.addEventListener('click', function (event) {
        if (event.target === dialog) closeDialog();
    });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !dialog.hidden) closeDialog();
    });
})();
</script>
