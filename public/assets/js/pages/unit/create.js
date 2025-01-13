(function () {
    const formcreateUnit = document.querySelector('#formcreateUnit');
    // Form validation for Add new record
    if (formcreateUnit) {
        const fv = FormValidation.formValidation(formcreateUnit, {
            fields: {
                kode_unit: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Unit Harus Diisi'
                        },
                        stringLength: {
                            max: 3,
                            min:3,
                            message: 'Kode Unit Harus 3 Karakter '
                        },
                    }
                },
                nama_unit: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Unit Harus Diisi'
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
                submitButton: new FormValidation.plugins.SubmitButton(),

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
