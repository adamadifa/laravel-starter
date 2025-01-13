(function () {
    const formcreateKaryawan = document.querySelector('#formcreateKaryawan');
    // Form validation for Add new record
    if (formcreateKaryawan) {
        const fv = FormValidation.formValidation(formcreateKaryawan, {
            fields: {
                npp: {
                    validators: {
                        notEmpty: {
                            message: 'NPP Harus Diisi'
                        },

                        stringLength: {
                            max: 10,
                            message: 'Maksimal 10 Karakter '
                        },
                    }
                },

                no_kk: {
                    validators: {
                        
                        stringLength: {
                            max: 16,
                            message: 'Maksimal 10 Karakter '
                        },
                    }
                },
                no_ktp: {
                    validators: {
                        notEmpty: {
                            message: 'No. KTP  Harus Diisi'
                        },

                        stringLength: {
                            max: 16,
                            message: 'Maksimal 10 Karakter '
                        },
                    }
                },

                nama_lengkap: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Lengkap  Harus Diisi'
                        }
                    }
                },

                jenis_kelamin: {
                    validators: {
                        notEmpty: {
                            message: 'Jenis Kelamin Harus Diisi'
                        }
                    }
                },

                tempat_lahir: {
                    validators: {
                        notEmpty: {
                            message: 'Tempat Lahir  Harus Diisi'
                        }
                    }
                },

                tanggal_lahir: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal Lahir  Harus Diisi'
                        }
                    }
                },

                no_hp: {
                    validators: {
                        notEmpty: {
                            message: 'No. HP  Harus Diisi'
                        },

                        numeric: {
                            message: 'No. HP Harus Berupa Angka'
                        }
                    }
                },

                alamat_ktp: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat KTP  Harus Diisi'
                        }
                    }
                },

                alamat_tinggal: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat Tinggal  Harus Diisi'
                        }
                    }
                },

                tmt: {
                    validators: {
                        notEmpty: {
                            message: 'TMT Harus Diisi'
                        }
                    }
                },

                status_karyawan: {
                    validators: {
                        notEmpty: {
                            message: 'Status Karyawan Harus Diiis'
                        }
                    }
                },

                pendidikan_terakhir: {
                    validators: {
                        notEmpty: {
                            message: 'Pendidikan Terakhir  Harus Diisi'
                        }
                    }
                },

                kode_jabatan: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat Tinggal  Harus Diisi'
                        }
                    }
                },

                kode_unit: {
                    validators: {
                        notEmpty: {
                            message: 'Unit  Harus Diisi'
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
