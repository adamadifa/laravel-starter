(function () {
    const formTahunajaran = document.querySelector('#formTahunajaran');
    // Form validation for Add new record
    if (formTahunajaran) {
        const fv = FormValidation.formValidation(formTahunajaran, {
            fields: {
                kode_ta: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Tahun Ajaran Harus Diisi'
                        },
                        stringLength: {
                            max: 6,
                            min: 6,
                            message: 'Kode Tahun Ajaran Harus 5 Karakter '
                        },
                    }
                },
                tahun_ajaran: {
                    validators: {
                        notEmpty: {
                            message: 'Tahun Ajaran Harus Diisi'
                        }
                    }
                },
                status: {
                    validators: {
                        notEmpty: {
                            message: 'Status Harus Diisi'
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
