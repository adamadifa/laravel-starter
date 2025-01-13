(function () {
    const formcreateJamkerja = document.querySelector('#formcreateJamkerja');
    // Form validation for Add new record
    if (formcreateJamkerja) {
        const fv = FormValidation.formValidation(formcreateJamkerja, {
            fields: {
                kode_jam_kerja: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Jam Kerja Harus Diisi'
                        },
                        stringLength: {
                            max: 4,
                            min:4,
                            message: 'Kode Jam Kerja Harus 4 Karakter '
                        },
                    }
                },
                nama_jam_kerja: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Jam Kerja Harus Diisi'
                        }
                    }
                },

                jam_masuk: {
                    validators: {
                        notEmpty: {
                            message: 'Jam Masuk Harus Diisi'
                        }
                    }
                },

                jam_pulang: {
                    validators: {
                        notEmpty: {
                            message: 'Jam Pulang Harus Diisi'
                        }
                    }
                },
                total_jam: {
                    validators: {
                        notEmpty: {
                            message: 'Total Jam Harus Diisi'
                        }
                    }
                },

                lintas_hari: {
                    validators: {
                        notEmpty: {
                            message: 'Lintas Hari Harus Diisi'
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
