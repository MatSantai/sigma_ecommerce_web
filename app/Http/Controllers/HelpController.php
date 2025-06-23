<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display the help/FAQ page.
     */
    public function index()
    {
        return view('help.index');
    }

    /**
     * Get help content for AJAX requests.
     */
    public function getHelpContent()
    {
        $helpContent = [
            'benefits' => [
                'title' => 'Why Choose Sigma Shop?',
                'items' => [
                    [
                        'icon' => 'fas fa-shipping-fast',
                        'title' => 'Fast & Reliable Shipping',
                        'description' => 'Get your orders delivered quickly and safely to your doorstep.'
                    ],
                    [
                        'icon' => 'fas fa-shield-alt',
                        'title' => 'Secure Shopping',
                        'description' => 'Your personal and payment information is protected with industry-standard security.'
                    ],
                    [
                        'icon' => 'fas fa-medal',
                        'title' => 'Quality Products',
                        'description' => 'We offer only the highest quality products from trusted brands.'
                    ],
                    [
                        'icon' => 'fas fa-headset',
                        'title' => '24/7 Customer Support',
                        'description' => 'Our support team is always ready to help you with any questions or issues.'
                    ],
                    [
                        'icon' => 'fas fa-undo',
                        'title' => 'Easy Returns',
                        'description' => 'Not satisfied? We offer hassle-free returns and exchanges.'
                    ],
                    [
                        'icon' => 'fas fa-tags',
                        'title' => 'Best Prices',
                        'description' => 'Competitive prices and regular discounts to save you money.'
                    ]
                ]
            ],
            'how_to_use' => [
                'title' => 'How to Use Sigma Shop',
                'steps' => [
                    [
                        'number' => '1',
                        'title' => 'Browse Products',
                        'description' => 'Explore our product catalog by clicking on "Shop" in the navigation menu. You can view products by category or search for specific items.',
                        'icon' => 'fas fa-search'
                    ],
                    [
                        'number' => '2',
                        'title' => 'Add to Cart',
                        'description' => 'Click the "Add to Cart" button on any product you want to purchase. You can adjust quantities before adding.',
                        'icon' => 'fas fa-cart-plus'
                    ],
                    [
                        'number' => '3',
                        'title' => 'Review Cart',
                        'description' => 'Click the cart icon in the navigation to review your items. You can modify quantities or remove items.',
                        'icon' => 'fas fa-shopping-cart'
                    ],
                    [
                        'number' => '4',
                        'title' => 'Checkout',
                        'description' => 'Click "Checkout" to proceed. Fill in your shipping and payment information.',
                        'icon' => 'fas fa-credit-card'
                    ],
                    [
                        'number' => '5',
                        'title' => 'Track Order',
                        'description' => 'After purchase, you can track your order status in your profile section.',
                        'icon' => 'fas fa-truck'
                    ]
                ]
            ],
            'faq' => [
                'title' => 'Frequently Asked Questions',
                'questions' => [
                    [
                        'question' => 'How do I create an account?',
                        'answer' => 'Click "Register" in the top navigation, fill in your details, and click "Create Account". You\'ll receive a confirmation email.'
                    ],
                    [
                        'question' => 'What payment methods do you accept?',
                        'answer' => 'We accept all major credit cards, debit cards, and digital wallets for secure payments.'
                    ],
                    [
                        'question' => 'How long does shipping take?',
                        'answer' => 'Standard shipping takes 3-5 business days. Express shipping (1-2 days) is available for an additional fee.'
                    ],
                    [
                        'question' => 'Can I cancel my order?',
                        'answer' => 'Orders can be cancelled within 1 hour of placement. Contact our support team immediately if you need to cancel.'
                    ],
                    [
                        'question' => 'What is your return policy?',
                        'answer' => 'We offer 30-day returns for most items. Products must be unused and in original packaging.'
                    ],
                    [
                        'question' => 'How can I contact customer support?',
                        'answer' => 'Use our Contact page, email us at support@sigmashop.com, or call us at 1-800-SIGMA-SHOP.'
                    ]
                ]
            ]
        ];

        return response()->json($helpContent);
    }
} 