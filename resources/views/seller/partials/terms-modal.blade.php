@push('modals')
    @can('seller-access')
        @if (Auth::user()->terms_accepted_at === null)

            <style>
                html,
                body {
                    overflow-x: hidden;
                }

                body.modal-open {
                    padding-right: 0 !important;
                }

                #acceptBTN,
                #accept_terms {
                    background-color: #056659ff;
                }

                .bg-prima {
                    background-color: #056659ff;
                }

                .text-prima {
                    color: #056659ff;
                }

                .modal.fade .modal-dialog {
                    transform: scale(0.8);
                    transition: transform 0.3s ease-out;
                }

                .modal.fade.show .modal-dialog {
                    transform: scale(1);
                }
            </style>

            <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true"
                data-bs-backdrop="static" data-bs-keyboard="false">  <!-- 🔒 Prevent outside click/esc -->
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Header -->
                        <div class="modal-header bg-prima text-white">
                            <h5 class="modal-title" id="termsModalLabel">Seller Onboarding</h5>
                            <!-- ❌ Removed close button so they must accept -->
                        </div>

                        <!-- Body -->
                        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                            <p class="mb-3">
                                Welcome to your Seller Dashboard! Before you begin, please review the
                                instructions and terms below carefully:
                            </p>

                            <h6 class="fw-bold text-prima">How to Use Your Toolkit</h6>
                            <ul>
                                <li><strong>Manage Products</strong> – Edit, update, or remove your listings.</li>
                                <li><strong>Add New Product</strong> – List fresh items directly to the market.</li>
                                <li><strong>Ratings</strong> – Monitor buyer reviews and feedback.</li>
                                <li><strong>Reserve List</strong> – Handle reservations promptly.</li>
                                <li><strong>Chats</strong> – Communicate directly with buyers.</li>
                                <li><strong>Market Analysis</strong> – Track trends to optimize pricing and demand.</li>
                                <li><strong>System Notifications</strong> – Stay updated with platform alerts.</li>
                            </ul>

                            <hr>

                            <form action="{{ route('seller.terms.accept') }}" method="POST">
                                @csrf
                                <h6 class="fw-bold text-prima">Terms & Conditions</h6>
                                <ul>
                                    <li>Provide accurate product information at all times.</li>
                                    <li>Ensure timely delivery of confirmed orders.</li>
                                    <li>Maintain professionalism when chatting with buyers.</li>
                                    <li>Comply with our community standards and platform policies.</li>
                                </ul>
                                <p class="mt-2">
                                    Please read carefully before accepting. Violation of these terms may result in
                                    suspension of your seller account.
                                </p>

                                <div class="form-check mt-3">
                                    <input type="checkbox" name="accept_terms" id="accept_terms" class="form-check-input" required>
                                    <label for="accept_terms" class="form-check-label">
                                        I have read and agree to the Terms & Conditions
                                    </label>
                                </div>
                                <hr>
                                <div class="flex justify-center">
                                    <button type="submit" class="btn mt-3 text-white" id="acceptBTN">Accept & Continue</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var termsModalEl = document.getElementById('termsModal');
                    var termsModal = new bootstrap.Modal(termsModalEl, {
                        backdrop: 'static',
                        keyboard: false
                    });
                    termsModal.show();
                });
            </script>
        @endif
    @endcan
@endpush
