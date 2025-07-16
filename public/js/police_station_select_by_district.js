// function setupPoliceStationSelect(districtSelectorId,  policeStationSelectorId) {
//     $(document).ready(function () {
//         $(districtSelectorId).on('change', function () {
//             let districtId = $(districtSelectorId).val();


//             if (districtId ) {
//                 $.ajax({
//                     url: "/api/police-stations/select2",
//                     type: 'GET',
//                     data: {
//                         district_id: districtId
//                     },
//                     success: function (response) {

//                         let policeStationSelect = $(policeStationSelectorId);

//                         policeStationSelect.empty();
//                         policeStationSelect.append('<option value="">Select Police Station</option>');

//                         $.each(response.data, function (key, ps) {
//                             policeStationSelect.append('<option value="' + ps.id + '">' + ps.name + '</option>');
//                         });
//                     },
//                     error: function () {
//                         alert('Failed to load sections. Please try again.');
//                     }
//                 });
//             }
//         });
//     });
// }


function setupPoliceStationSelect(districtSelectorId, policeStationSelectorId, selectedId = null) {
    $(document).ready(function () {
        function loadPoliceStations(districtId, selectedId = null) {
            if (districtId) {
                $.ajax({
                    url: "/api/police-stations/select2",
                    type: 'GET',
                    data: { district_id: districtId },
                    success: function (response) {
                        let policeStationSelect = $(policeStationSelectorId);
                        policeStationSelect.empty();
                        policeStationSelect.append('<option value="">Select Police Station</option>');

                        $.each(response.data, function (key, ps) {
                            let selected = selectedId == ps.id ? 'selected' : '';
                            policeStationSelect.append('<option value="' + ps.id + '" ' + selected + '>' + ps.name + '</option>');
                        });

                        policeStationSelect.trigger('change.select2');
                    },
                    error: function () {
                        alert('Failed to load police stations. Please try again.');
                    }
                });
            }
        }

        // On change event
        $(districtSelectorId).on('change', function () {
            let districtId = $(districtSelectorId).val();
            loadPoliceStations(districtId);
        });

        // Initial load if value exists
        let initialDistrictId = $(districtSelectorId).val();
        let selectedPoliceStationId = $(policeStationSelectorId).data('selected');
        if (initialDistrictId && selectedPoliceStationId) {
            loadPoliceStations(initialDistrictId, selectedPoliceStationId);
        }
    });
}

