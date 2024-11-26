(function () {
    const formcreateJabatan = document.querySelector('#formcreateJabatan');
    // Form validation for Add new record
    if (formcreateJabatan) {
        const fv = FormValidation.formValidation(formcreateJabatan, {
            fields: {
                kode_jabatan: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Jabatan Harus Diisi'
                        },
                        stringLength: {
                            max: 3,
                            min:3,
                            message: 'Kode Jabatan Harus 3 Karakter '
                        },
                    }
                },
                nama_jabatan: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Jabatan Harus Diisi'
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
