(function () {
    const formcreateDepartemen = document.querySelector('#formcreateDepartemen');
    // Form validation for Add new record
    if (formcreateDepartemen) {
        const fv = FormValidation.formValidation(formcreateDepartemen, {
            fields: {
                kode_dept: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Departemen Harus Diisi'
                        },
                        stringLength: {
                            max: 3,
                            min:3,
                            message: 'Kode Departemen Harus 3 Karakter '
                        },
                    }
                },
                nama_dept: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Departemen Harus Diisi'
                        }
                    }
                }

            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: '.mb-3'
                }),
                // submitButton: new FormValidation.plugins.SubmitButton(),
                submitButton: new FormValidation.plugins.SubmitButton({
                    selector: '#formcreateDepartemen input[type="submit"]',
                    disabled: true
                }),
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
                instance.on('plugins.message.placed', function (e) {
                    if (e.element.parentElement.classList.contains('input-group')) {
                        e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                    }
                });
            }
        });
    }
})();
