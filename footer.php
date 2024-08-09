    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <h5>Follow Us</h5>
            <div class="mt-3">
                <a href="https://www.instagram.com/areautara/" target="_blank" class="text-white mx-3">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
                <a href="https://www.facebook.com/areautaraultras/" target="_blank" class="text-white mx-3">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="https://wa.me/+6285161242408" target="_blank" class="text-white mx-3">
                    <i class="fab fa-whatsapp fa-2x"></i>
                </a>
            </div>
            <p class="mt-3 mb-0">&copy; 2024 AreaUtara. All rights reserved.</p>
        </div>
    </footer>

    <!-- Include JS at the end of the body -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>

    <script>
        // helper function
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(String(email).toLowerCase());
        }

        function generateReceiptId(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            const charactersLength = characters.length;
            
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }

            return result;
        }

        function now() {
            return Math.floor(Date.now() / 1000);
        }
        
        function formatCurrency(value) {
            return 'Rp' + value.toLocaleString('id-ID', { minimumFractionDigits: 0 }).replace(/\s/g, '');
        }
    </script>