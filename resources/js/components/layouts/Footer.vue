<template>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Exam System</b> Karachi
        </div>
        <strong>Copyright &copy; {{current_year}} <a href="https://www.linkedin.com/in/hassan-ali-a73a07115">Hassan Ali</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

</template>

<script>
export default {
    name: "Footer",
    data() {
        return {
            current_year: new Date().getFullYear()
        }
    },
    mounted() {

    }

}
</script>
