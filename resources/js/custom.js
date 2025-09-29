     // create slug based on name field
    $('#name').on('input', function () {
        let slug = $(this).val()
            .toLowerCase()
            .replace(/\s+/g, '-')        
            .replace(/[^a-z0-9\-]/g, '') 
            .replace(/\-+/g, '-')        
            .replace(/^-+|-+$/g, '');

        $('#slug').val(slug);
    });

    // search a category
    $('#search').on('keyup', function() {
        let query = $(this).val();
        let url = $('#search').data('url');

        if (query.length > 1) {
            $.ajax({
                url: url,
                type: "GET",
                data: { q: query },
                success: function(data) {
                    let results = '';
                    if (data.length > 0) {
                        data.forEach(function(item) {
                            results += `<li class="list-group-item">${item.name} (${item.slug})</li>`;
                        });
                    } else {
                        results = `<li class="list-group-item text-muted">No Results Found</li>`;
                    }
                    $('#search-results').html(results);
                }
            });
        } else {
            $('#search-results').html('');
        }
    });
