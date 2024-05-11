<script>

    function dzComplete(_this, file, mockFile = '', mediaMockFile = '') {
        if (mockFile !== '') {
            _this.removeFile(mockFile);
            mockFile = '';
        }
        if (mediaMockFile !== '' && _this.element.id === mediaMockFile.collection_name) {
            _this.removeFile(mediaMockFile);
            mediaMockFile = '';
        }
        if (file._removeLink) {
            file._removeLink.textContent = _this.options.dictRemoveFile;
        }
        if (file.previewElement) {
            return file.previewElement.classList.add("dz-complete");
        }
    }

    function dzCompleteMultiple(_this, file) {
        if (file._removeLink) {
            file._removeLink.textContent = _this.options.dictRemoveFile;
        }
        if (file.previewElement) {
            return file.previewElement.classList.add("dz-complete");
        }
    }

    function dzRemoveFile(file, mockFile = '', existRemoveUrl = '', collection, modelId, newRemoveUrl, csrf) {
        if (file.previewElement != null && file.previewElement.parentNode != null) {
            file.previewElement.parentNode.removeChild(file.previewElement);
        }
        //if(file.status === 'success'){
        if (mockFile !== '') {
            mockFile = '';
            $.post(existRemoveUrl,
                {
                    _token: csrf,
                    id: modelId,
                    collection: collection,
                });
        } /*else {
            $.post(newRemoveUrl,
                {
                    _token: csrf,
                    uuid: file.upload.uuid
                });
        }*/
        //}
    }

    function dzRemoveFileMultiple(file, mockFile = [], existRemoveUrl = '', collection, modelId, newRemoveUrl, csrf) {
        if (file.previewElement != null && file.previewElement.parentNode != null) {
            file.previewElement.parentNode.removeChild(file.previewElement);
        }

        if (mockFile.length !== 0) {
            mockFile = [];
            $.post(existRemoveUrl,
                {
                    _token: csrf,
                    id: modelId,
                    collection: collection,
                    uuid: file.uuid,
                });
        }
        if (file.upload != null) {
            $('input#' + file.upload.uuid).remove();
        }
    }

    function dzSending(_this, file, formData, csrf) {
        console.log('dzSendingMultiple');
        console.log(file.element);
        file.previewElement.children[0].value = file.upload.uuid;
        formData.append('_token', csrf);
        formData.append('field', file.previewElement.dataset.field);
        formData.append('uuid', file.upload.uuid);
    }

    function dzSendingMultiple(_this, file, formData, csrf) {
        $(file.previewElement).prepend('<input type="hidden" name="image[]">');
        console.log('dzSendingMultiple');
        console.log(file.previewElement);
        file.previewElement.children[0].value = file.upload.uuid;
        file.previewElement.children[0].id = file.upload.uuid;

        formData.append('_token', csrf);
        formData.append('field', file.previewElement.dataset.field);
        formData.append('uuid', file.upload.uuid);
    }

    function dzMaxfile(_this, file) {
        _this.removeAllFiles();
        _this.addFile(file);
    }

    function dzInit(_this, mockFile, thumb) {
        _this.options.addedfile.call(_this, mockFile);
        _this.options.thumbnail.call(_this, mockFile, thumb);
        mockFile.previewElement.classList.add('dz-success');
        mockFile.previewElement.classList.add('dz-complete');
    }

    function dzAccept(file, done, dzElement = '.dropzone', iconBaseUrl) {
        var ext = file.name.split('.').pop().toLowerCase();
        if (['jpg', 'png', 'gif', 'jpeg', 'bmp'].indexOf(ext) === -1) {
            var thumbnail = $(dzElement).find('.dz-preview.dz-file-preview .dz-image:last');
            var icon = iconBaseUrl + "/" + ext + ".png";
            thumbnail.css('background-image', 'url(' + icon + ')');
            thumbnail.css('background-size', 'contain');
        }
        done();
    }
    $(document).on('click', ".btn-delete", function (e) {
        e.preventDefault();
        let me = $(this);
        let url = me.attr('href');
        console.log("btn-delete");
        Swal.fire({
            title: me.data('alert-title'),
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: me.data('confirm'),
            cancelButtonText: me.data('cancel'),
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                    },
                    success: function (response) {
                        let data = response;
                        console.log(data);
                        if (data.error) {
                            Swal.fire(data.message, '', 'warning');
                        } else {
                            Swal.fire(data.message, '', 'success').then(function() {
                                window.location.reload(); // Reload window after success
                            });
                        }
                    },
                    error: function (error) {
                        Swal.fire(error.responseJSON.message, '', "warning");
                        console.log(error);
                    }
                });
            }
        });
    });
</script>
