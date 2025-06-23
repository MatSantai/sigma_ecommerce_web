@extends('layouts.app')

@section('title', 'Help & FAQ')

@section('content')
<div class="bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Help & FAQ</h1>
            <p class="text-lg text-gray-400">Everything you need to know about Sigma Shop</p>
        </div>

        <!-- Benefits Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-white mb-8 text-center">Why Choose Sigma Shop?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition-colors">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-shipping-fast text-blue-400 text-2xl mr-3"></i>
                        <h3 class="text-xl font-semibold text-white">Fast & Reliable Shipping</h3>
                    </div>
                    <p class="text-gray-300">Get your orders delivered quickly and safely to your doorstep.</p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition-colors">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-shield-alt text-green-400 text-2xl mr-3"></i>
                        <h3 class="text-xl font-semibold text-white">Secure Shopping</h3>
                    </div>
                    <p class="text-gray-300">Your personal and payment information is protected with industry-standard security.</p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition-colors">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-medal text-yellow-400 text-2xl mr-3"></i>
                        <h3 class="text-xl font-semibold text-white">Quality Products</h3>
                    </div>
                    <p class="text-gray-300">We offer only the highest quality products from trusted brands.</p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition-colors">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-headset text-purple-400 text-2xl mr-3"></i>
                        <h3 class="text-xl font-semibold text-white">24/7 Customer Support</h3>
                    </div>
                    <p class="text-gray-300">Our support team is always ready to help you with any questions or issues.</p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition-colors">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-undo text-red-400 text-2xl mr-3"></i>
                        <h3 class="text-xl font-semibold text-white">Easy Returns</h3>
                    </div>
                    <p class="text-gray-300">Not satisfied? We offer hassle-free returns and exchanges.</p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition-colors">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-tags text-pink-400 text-2xl mr-3"></i>
                        <h3 class="text-xl font-semibold text-white">Best Prices</h3>
                    </div>
                    <p class="text-gray-300">Competitive prices and regular discounts to save you money.</p>
                </div>
            </div>
        </div>

        <!-- How to Use Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-white mb-8 text-center">How to Use Sigma Shop</h2>
            <div class="space-y-6">
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg">1</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Browse Products</h3>
                            <p class="text-gray-300">Explore our product catalog by clicking on "Shop" in the navigation menu. You can view products by category or search for specific items.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg">2</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Add to Cart</h3>
                            <p class="text-gray-300">Click the "Add to Cart" button on any product you want to purchase. You can adjust quantities before adding.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-yellow-600 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg">3</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Review Cart</h3>
                            <p class="text-gray-300">Click the cart icon in the navigation to review your items. You can modify quantities or remove items.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg">4</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Checkout</h3>
                            <p class="text-gray-300">Click "Checkout" to proceed. Fill in your shipping and payment information.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-red-600 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg">5</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Track Order</h3>
                            <p class="text-gray-300">After purchase, you can track your order status in your profile section.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-white mb-8 text-center">Frequently Asked Questions</h2>
            <div class="space-y-4">
                <div class="bg-gray-800 rounded-lg border border-gray-700">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">How do I create an account?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </div>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-300">Click "Register" in the top navigation, fill in your details, and click "Create Account". You'll receive a confirmation email.</p>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg border border-gray-700">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">What payment methods do you accept?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </div>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-300">We accept all major credit cards, debit cards, and digital wallets for secure payments.</p>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg border border-gray-700">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">How long does shipping take?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </div>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-300">Standard shipping takes 3-5 business days. Express shipping (1-2 days) is available for an additional fee.</p>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg border border-gray-700">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">Can I cancel my order?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </div>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-300">Orders can be cancelled within 1 hour of placement. Contact our support team immediately if you need to cancel.</p>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg border border-gray-700">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">What is your return policy?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </div>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-300">We offer 30-day returns for most items. Products must be unused and in original packaging.</p>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg border border-gray-700">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">How can I contact customer support?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </div>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-300">Use our Contact page, email us at support@sigmashop.com, or call us at 1-800-SIGMA-SHOP.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Support Section -->
        <div class="text-center">
            <div class="bg-gray-800 rounded-lg p-8 border border-gray-700">
                <h3 class="text-2xl font-bold text-white mb-4">Still Need Help?</h3>
                <p class="text-gray-300 mb-6">Our customer support team is here to help you with any questions or issues.</p>
                <a href="{{ route('contact.show') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFAQ(button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector('i');
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>
@endsection 