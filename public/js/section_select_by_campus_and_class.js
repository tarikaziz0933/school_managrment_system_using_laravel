function setupSectionSelect(campusSelectorId, classSelectorId, sectionSelectorId) {
    $(document).ready(function () {
        $(campusSelectorId + ', ' + classSelectorId).on('change', function () {
            let campusId = $(campusSelectorId).val();
            let classId = $(classSelectorId).val();

            console.log(campusId, classId);

            if (campusId && classId) {
                $.ajax({
                    url: "/api/sections/select2",
                    type: 'GET',
                    data: {
                        campus_id: campusId,
                        class_id: classId
                    },
                    success: function (response) {
                        let sectionSelect = $(sectionSelectorId);

                        console.log(response.data);

                        sectionSelect.empty();
                        sectionSelect.append('<option value="">Select Section</option>');

                        // $.each(response.data, function (key, section) {
                        //     sectionSelect.append('<option value="' + section.id + '">' + section.name + '</option>');
                        // });
                        $.each(response.data, function (key, section) {
                            let genderText = section.gender ? ' (' + section.gender + ')' : ' (Combined)';
                            sectionSelect.append('<option value="' + section.id + '">' + section.name + genderText + '</option>');
                        });
                        sectionSelect.trigger('change.select2');
                    },
                    error: function () {
                        alert('Failed to load sections. Please try again.');
                    }
                });
            }
        });
    });
}
