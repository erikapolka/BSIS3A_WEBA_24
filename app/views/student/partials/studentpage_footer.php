</div>
</div>

<!-- Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>


<script>
    $(document).ready(function() {
        

        
        //auto hide alert
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000);

        const config = {

            search: true, // Toggle search feature. Default: false
            creatable: false, // Creatable selection. Default: false
            clearable: false, // Clearable selection. Default: false
            maxHeight: '360px', // Max height for showing scrollbar. Default: 360px
            size: '', // Can be "sm" or "lg". Default ''
        }
        dselect(document.querySelector('#dSelect'), config),
            dselect(document.querySelector('#dSelectSection'), config),
            dselect(document.querySelector('#dSelectFacultyResult'), config),
            dselect(document.querySelector('#dSelectCriteria'), config)


    });
</script>

</body>

</html>