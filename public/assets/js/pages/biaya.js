(function () {
    const formBiaya = document.querySelector('#formBiaya');
    // Form validation for Add new record
    if (formBiaya) {
        const fv = FormValidation.formValidation(formBiaya, {
            fields: {
                kode_jenis_biaya: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Biaya Harus Diisi'
                        },
                        stringLength: {
                            max: 3,
                            min: 3,
                            message: 'Kode Biaya Harus 3 Karakter '
                        },
                    }
                },
                jenis_biaya: {
                    validators: {
                        notEmpty: {
                            message: 'Jenis Biaya Harus Diisi'
                        }
                    }
                },

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
