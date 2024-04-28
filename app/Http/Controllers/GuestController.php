<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Products;
use App\Models\Network;
use App\Models\Package;
use App\Models\Amount;
use App\Models\Client;
use App\Models\Load;
use App\Models\History;

use App\Models\Mop;


class GuestController extends Controller
{

    public function index()
    {

        $this->sharedData();

        return view('welcome');
    }

    public function aboutUs()
    {
        $this->sharedData();
        return view('aboutus');
    }

    public function products() {
        $this->sharedData();
        return view('products');
    }

    public function clients() {
        $this->sharedData();
        return view('clients');
    }

    public function dashboard() {
        $this->sharedData();
        $mops = Mop::get();
        $networks = Network::get();
        $amounts = Amount::get();
        $histories = History::where('user_id',auth()->id())->get();
        $number = auth()->user()->number;
        $packages = Package::get();

        $quickAmount = [
            // min amount = 5000 create list of amount increment by 100
            '5000' => [
                'name' => 5000,
                'value' => 5000,
            ],
            '10000' => [
                'name' => 10000,
                'value' => 10000,
            ],
            '15000' => [
                'name' => 15000,
                'value' => 15000,
            ],
            '20000' => [
                'name' => 20000,
                'value' => 20000,
            ],
            '25000' => [
                'name' => 25000,
                'value' => 25000,
            ],
            '30000' => [
                'name' => 30000,
                'value' => 30000,
            ],
        ];
        //conver to compact
        return view('dashboard', compact('mops','histories','networks','amounts','packages','number','quickAmount'));
    }

    public function contact() {
        $this->sharedData();
        return view('contact');
    }

    public function checkEmail(Request $request)
    {
        $email = $request->email;
        //check if email exist in db on Client table
        $client = Client::where('email', $email)->first();

        return response()->json(['exist' => $client ? true : false]);
    }

    public function loadNow(Request $request)
    {
        return 'test';
    }

    public function requestLoad (Request $request) {

        $validatedData = $request->validate([
            'full_name' => 'required|max:255',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email',
            'payment_method' => 'required',
            'network' => 'required',
            'transaction_receipt' => 'required|file',
        ]);

        $load = new Load;
        $load->name = $request->full_name;
        $load->number = $request->phone_number;
        $load->email = $request->email;
        $load->type = $request->load_types;
        $load->mop = $request->payment_method;
        $load->network_id = $request->network;
        $load->amount_id = $request->amount ?? null;
        $load->package_id = $request->package ?? null;

        if ($request->hasFile('transaction_receipt')) {
            $imagePath = $request->file('transaction_receipt')->store('receipts', 'public');
            $load->image = $imagePath;
        }
        $load->save();

        return $load;

    }

    public function sharedData()
    {
        //to-do replace this data base on admin
        $iconData = [
            [
            'iconUrl' => asset('images/icons/telephone.svg'),
            'value' => '+63287904028',
            ],
            [
                'iconUrl' => asset('images/icons/email.svg'),
                'value' => 'official@marinodatatopupph.com',
            ],
            [
                'iconUrl' => asset('images/icons/location-marker.svg'),
                'value' => '12 Floor Room 1222 Times Plaza Building UN Ave. Ermita Manila',
            ],
        ];

        $companyName = 'Marino Data Top Up Ph Corp';

        $missionText =  'To help Filipino seafarers and travelers connected to their love ones in an easy and quick service for a very affordable price';

        $navLinks = [
            [
                'linkUrl' =>  route('home'),
                'page' => 'Home',
                'child' => false,
            ],
            [
                'linkUrl' => route('products'),
                'page' => 'Products',
                'child' => false,
                'children' => [
                    [
                        'linkUrl' => '#',
                        'page' => 'SIM',
                    ],
                    [
                        'linkUrl' => '#',
                        'page' => 'Product 2',
                    ],
                ],
            ],
            [
                'linkUrl' => route('contact'),
                'page' => 'Contact us',
                'child' => false,
            ],
            [
                'linkUrl' => route('clients'),
                'page' => 'Our Clients',
                'child' => false,
            ],
            [
                'linkUrl' => route('about-us'),
                'page' => 'About us',
                'child' => false,
            ],
            [
                'linkUrl' => route('login'),
                'page' => 'Login',
                'child' => false,
            ],
            [
                'linkUrl' => route('register'),
                'page' => 'Register',
                'child' => false,
            ],
        ];

        // Modify the "Products" link without looping through the array
        $footerNavLinks = array_map(function ($link) {
            if ($link['page'] === 'Products') {
                $link['child'] = false;
                foreach ($link['children'] as &$childLink) {
                    $childLink['child'] = false;
                }
            }
            return $link;
        }, $navLinks);

        $iconDataFooter = [

            [
            'iconUrl' => asset('images/icons/whatsapp.svg'),
            'value' => '+639159966353',
            ],
            [
                'iconUrl' => asset('images/icons/mobile.svg'),
                'value' => '+639159966353 +639762535769',
            ],
            [
                'iconUrl' => asset('images/icons/telephone.svg'),
                'value' => '+63287904028',
            ],
            [
                'iconUrl' => asset('images/icons/email.svg'),
                'value' => 'official@marinodatatopupph.com',
            ],
            [
                'iconUrl' => asset('images/icons/location-marker.svg'),
                'value' => '12 Floor Room 1222 Times Plaza Building UN Ave. Ermita Manila',
            ],
            [
                'iconUrl' => asset('images/icons/fb-icon.svg'),
                'value' => 'FLORA MAE BAÑAS-LLANERA',
            ],
        ];

        $learnMoreText = 'Learn more';

        $buyNowText = 'Buy now';


        $servicess = [
            [
                'image' =>  asset('images/icons/satelite.svg'),
                'title' => 'Worldwide connectivity',
                'description' => 'Seafarers can use Marino sim all around the world in multiple countries. No need to look for a local sim card anymore or rely on slow and expensive satellite connection.'
            ],
            [
                'image' =>  asset('images/icons/moneyhand.svg'),
                'title' => 'Amazing prices',
                'description' => 'provides almost local prices and helps you save %90 on your roaming costs'
            ],
            [
                'image' =>  asset('images/icons/phonesignal.svg'),
                'title' => 'Simple to use',
                'description' => 'Easy to use and configure with our instruction will guide you to enjoy our products.'
            ],
            [
                'image' =>  asset('images/icons/globe.svg'),
                'title' => 'Data-only packages',
                'description' => 'Offers convenient data-only packages that can cover your voyage destinations seamlessly.'
            ],
            [
                'image' =>  asset('images/icons/pcup.svg'),
                'title' => 'Top up now pay later',
                'description' => 'We also offer top up now, pay later, further enhancing their experience with our services'
            ],
            [
                'image' =>  asset('images/icons/customer-service.svg'),
                'title' => 'Customer support',
                'description' => 'Our multilingual customer support team is available around the clock in 3 different time zones to make sure all your support needs are answered immediately.'
            ],
        ];

        $bannerText = "Unbeatable products for our Marino's we love!";

        $pruductsHeading = 'Our Products';
        $productSectionDescription = 'We offer wide range of international simcards and data packages that are available to ensure seamless connectivity across different countries and regions. Our company also offers 24/7 customer support to assist users with any technical issues or inquiries they may have';

        $products = Products::get();

        $testimonialHeading = 'Our Clients';

        $aboutUsHeading = 'About Us';
        $ourBrands = 'Our Brands';

        $aboutUsContent1 = [
            'title' => $aboutUsHeading,
            'content' => [
                [
                    'text' => "Marino Data Top Up Ph Corp., started on February 28, 2019 as
                    an online seller who offers data top up to all seafarers. Since its
                    inception, the company has rapidly gained popularity as an online
                    seller. With a strong focus on customer satisfaction, the company has
                    successfully carved a niche for itself in a competitive market. At first, it
                    was only for the personal use of my husband since he is also a seafarer,
                    but as word spread about our fast and convenience service of top up to
                    seafarers, demand began to grow exponentially. Recognizing the
                    potential for expansion, the company decided to offer its services to a
                    wider audience, catering not only to seafarers but also to individuals
                    and businesses in need of reliable data top-up solutions. This strategic
                    decision further propelled Marino Data Top Up Ph Corp.'s growth and
                    solidified its position as a trusted provider of top up and sim cards in
                    the online selling industry. "
                ],
                [
                    'text' => "As a company expansion we decided to get an office and register it as a
                    corporation to establish a more formal and professional presence in the
                    market. This allowed us to better serve our growing customer base and
                    build stronger relationships with our partners and supplier's.
                    Additionally, becoming a registered corporation vided us with legal
                    protection and enhanced credibility positioning us as a reputable player
                    in the industry. This also opens up opportunities for us to expand our
                    reach and establish strategic partnerships, enabling us to offer even
                    more competitive products and services in the future. "
                ],[
                    'text' => "We are now selling SIM cards from Thailand, United Kingdom, China
                    and Hongkong even a pocket Wi-Fi from Hongkong that is Pokefi
                    which allows us to cater to a diverse customer base and tap into
                    different markets. We also offer top up for almost all sim cards
                    worldwide and planning to have partnership to the biggest and best
                    internet provider in the world. This expansion not only increases our
                    revenue potential but also enhances our reputation as a reliable
                    provider of international sim cards and top up. Additionally, by
                    offering SIM cards from multiple countries, we can provide customers
                    with more options and flexibility in choosing the best plan that suits
                    their needs while traveling or staying abroad. "
                ],
            ]
        ];

        $aboutUsContent2 = [
            'title' => $ourBrands,
            'content' => [
                [
                    'text' => 'We offer wide range of international sim cards and data packages that are available to ensure seamless connectivity across different countries and regions. Our company also offers 24/7 customer support to assist users with any technical issues or inquiries they may have. Our Brands PRODUCTS OUR By establishing partnerships with major network providers globally, our company aims to create a comprehensive service that offers reliable and high-speed internet access to seafarers and travelers, enabling them to stay connected with their loved ones and access important information while on the go.'
                ],
                [
                    'text' => 'This initiative not only caters to the growing demand for connectivity at sea and in remote areas but also positions us as a leading player in providing data sim cards worldwide. International Simcard and Data 3uk AIS Talktiko Talk2all Pokefi We also offer top up now, pay later, further enhancing their experience with our services'
                ],
            ]
        ];

        $brands = [
            [
                'imageUrl' => asset('images/brand1.png')
            ],
            [
                'imageUrl' => asset('images/brand2.png')
            ],
            [
                'imageUrl' => asset('images/brand3.png')
            ],
            [
                'imageUrl' => asset('images/brand4.png')
            ],
        ];

        $aboutUsImg = asset('images/building.png');

        $testimonials = Testimonial::get();


        $productsList = [
                [
                    'image' => asset('images/products.png'),
                    'name' => 'TALKTIKO SIM',
                    'price' => 299,
                    'type' => 'SIM',
                    'link' => '#',
                    'countries' => 'Australia 5G, Bahrain 5G, Bangladesh, Brunei, Cambodia, China 5G, Georgia, Guam, Hong Kong 5G, India, Indonesia 5G, Israel 5G, Japan 5G, Jordan, Kazakhstan, Kuwait 5G, Laos, Macau, Malaysia, Mongolia, Myanmar (New), Nepal, Oman 5G, Pakistan, Philippines 5G, Qatar 5G, Singapore 5G, South Korea 5G, Sri Lanka, Taiwan, Tibet 5G, Uzbekistan, Vietnam 5G, Thailand 5G',
                    'notes' => 'User reported poor connection
                                AIS Roaming Partners by country listed here.
                                For India: Not Available in Diskit,Gulmarg, Jammu,Kargil, Kashmir, Katra, Leh, Plan Bandipora and Srinagar. (Update Sep 10,2022)
                                The use of 4G or 3G depends on the capabilities of the overseas service provider network.
                                1 Global SIM can be used in one or many countries
                                AIS will roam on its partner networks.',
                    'accordion' => [
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'Packages',
                            'visibility' => true
                        ],
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'how to top up',
                            'visibility' => true
                        ],
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'mode of payment',
                            'visibility' => true
                        ],
                    ]

                ],
                [
                    'image' => asset('images/products.png'),
                    'name' => 'TALKTIKO SIM',
                    'price' => 299,
                    'type' => 'SIM',
                    'link' => '#',
                    'countries' => 'Australia 5G, Bahrain 5G, Bangladesh, Brunei, Cambodia, China 5G, Georgia, Guam, Hong Kong 5G, India, Indonesia 5G, Israel 5G, Japan 5G, Jordan, Kazakhstan, Kuwait 5G, Laos, Macau, Malaysia, Mongolia, Myanmar (New), Nepal, Oman 5G, Pakistan, Philippines 5G, Qatar 5G, Singapore 5G, South Korea 5G, Sri Lanka, Taiwan, Tibet 5G, Uzbekistan, Vietnam 5G, Thailand 5G',
                    'notes' => 'User reported poor connection
                                AIS Roaming Partners by country listed here.
                                For India: Not Available in Diskit,Gulmarg, Jammu,Kargil, Kashmir, Katra, Leh, Plan Bandipora and Srinagar. (Update Sep 10,2022)
                                The use of 4G or 3G depends on the capabilities of the overseas service provider network.
                                1 Global SIM can be used in one or many countries
                                AIS will roam on its partner networks.',
                    'accordion' => [
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'Packages',
                            'visibility' => true
                        ],
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'how to top up',
                            'visibility' => true
                        ],
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'mode of payment',
                            'visibility' => true
                        ],
                    ]

                ],
                [
                    'image' => asset('images/products.png'),
                    'name' => 'TALKTIKO SIM',
                    'price' => 299,
                    'type' => 'SIM',
                    'link' => '#',
                    'countries' => 'Australia 5G, Bahrain 5G, Bangladesh, Brunei, Cambodia, China 5G, Georgia, Guam, Hong Kong 5G, India, Indonesia 5G, Israel 5G, Japan 5G, Jordan, Kazakhstan, Kuwait 5G, Laos, Macau, Malaysia, Mongolia, Myanmar (New), Nepal, Oman 5G, Pakistan, Philippines 5G, Qatar 5G, Singapore 5G, South Korea 5G, Sri Lanka, Taiwan, Tibet 5G, Uzbekistan, Vietnam 5G, Thailand 5G',
                    'notes' => 'User reported poor connection
                                AIS Roaming Partners by country listed here.
                                For India: Not Available in Diskit,Gulmarg, Jammu,Kargil, Kashmir, Katra, Leh, Plan Bandipora and Srinagar. (Update Sep 10,2022)
                                The use of 4G or 3G depends on the capabilities of the overseas service provider network.
                                1 Global SIM can be used in one or many countries
                                AIS will roam on its partner networks.',
                    'accordion' => [
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'Packages',
                            'visibility' => true
                        ],
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'how to top up',
                            'visibility' => true
                        ],
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'mode of payment',
                            'visibility' => true
                        ],
                    ]

                ],
                [
                    'image' => asset('images/products.png'),
                    'name' => 'TALKTIKO SIM',
                    'price' => 299,
                    'type' => 'SIM',
                    'link' => '#',
                    'countries' => 'Australia 5G, Bahrain 5G, Bangladesh, Brunei, Cambodia, China 5G, Georgia, Guam, Hong Kong 5G, India, Indonesia 5G, Israel 5G, Japan 5G, Jordan, Kazakhstan, Kuwait 5G, Laos, Macau, Malaysia, Mongolia, Myanmar (New), Nepal, Oman 5G, Pakistan, Philippines 5G, Qatar 5G, Singapore 5G, South Korea 5G, Sri Lanka, Taiwan, Tibet 5G, Uzbekistan, Vietnam 5G, Thailand 5G',
                    'notes' => 'User reported poor connection
                                AIS Roaming Partners by country listed here.
                                For India: Not Available in Diskit,Gulmarg, Jammu,Kargil, Kashmir, Katra, Leh, Plan Bandipora and Srinagar. (Update Sep 10,2022)
                                The use of 4G or 3G depends on the capabilities of the overseas service provider network.
                                1 Global SIM can be used in one or many countries
                                AIS will roam on its partner networks.',
                    'accordion' => [
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'Packages',
                            'visibility' => true
                        ],
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'how to top up',
                            'visibility' => true
                        ],
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'mode of payment',
                            'visibility' => true
                        ],
                    ]

                ],
                [
                    'image' => asset('images/products.png'),
                    'name' => 'TALKTIKO SIM',
                    'price' => 299,
                    'type' => 'SIM',
                    'link' => '#',
                    'countries' => 'Australia 5G, Bahrain 5G, Bangladesh, Brunei, Cambodia, China 5G, Georgia, Guam, Hong Kong 5G, India, Indonesia 5G, Israel 5G, Japan 5G, Jordan, Kazakhstan, Kuwait 5G, Laos, Macau, Malaysia, Mongolia, Myanmar (New), Nepal, Oman 5G, Pakistan, Philippines 5G, Qatar 5G, Singapore 5G, South Korea 5G, Sri Lanka, Taiwan, Tibet 5G, Uzbekistan, Vietnam 5G, Thailand 5G',
                    'notes' => 'User reported poor connection
                                AIS Roaming Partners by country listed here.
                                For India: Not Available in Diskit,Gulmarg, Jammu,Kargil, Kashmir, Katra, Leh, Plan Bandipora and Srinagar. (Update Sep 10,2022)
                                The use of 4G or 3G depends on the capabilities of the overseas service provider network.
                                1 Global SIM can be used in one or many countries
                                AIS will roam on its partner networks.',
                    'accordion' => [
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'Packages',
                            'visibility' => true
                        ],
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'how to top up',
                            'visibility' => true
                        ],
                        [
                            'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos',
                            'title' => 'mode of payment',
                            'visibility' => true
                        ],
                    ]

                ],

            ];

            $ourClientHeading = 'What our client says?';
            $ourClientHeadingDescription = 'We are very fortunate to have formed excellent partnerships with many of our clients. And we’ve formed more than just working relationships with them; we have formed true friendships. Here’s what they’re saying about us.';

            $testimonialList2 = [
                [
                    'name' => 'Capt. KimSeowon',
                    'position' => 'Korean Captain from Pan Ocean',
                    'rating' => 4,
                    'message' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet',
                    'image' => asset('images/products.png')
                ] ,
                [
                    'name' => 'Capt. KimSeowon',
                    'position' => 'Korean Captain from Pan Ocean',
                    'rating' => 4,
                    'message' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet',
                    'image' => asset('images/products.png')
                ] ,
                [
                    'name' => 'Capt. KimSeowon',
                    'position' => 'Korean Captain from Pan Ocean',
                    'rating' => 4,
                    'message' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet',
                    'image' => asset('images/products.png')
                ] ,
                [
                    'name' => 'Capt. KimSeowon',
                    'position' => 'Korean Captain from Pan Ocean',
                    'rating' => 4,
                    'message' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet',
                    'image' => asset('images/products.png')
                ] ,
                [
                    'name' => 'Capt. KimSeowon',
                    'position' => 'Korean Captain from Pan Ocean',
                    'rating' => 4,
                    'message' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet',
                    'image' => asset('images/products.png')
                ] ,
            ];

            $contactHeading = 'Contact us';
            $contactHeadingDescription = '';
            $contactUsImg = asset('images/emailpic.png');
            $contactContent1 = [
                'title' => 'Have questions? Send us a message on facebook.',
                'content' => [
                    [
                        'text' => 'By establishing partnerships with major network providers globally, our company aims to create a comprehensive service that offers reliable and high-speed internet access to seafarers and travelers, enabling them to stay connected with their loved ones and access important information while on the go. This initiative not only caters to the growing demand for connectivity at sea and in remote areas but also positions us as a leading player in providing data sim cards worldwide.'
                    ],
                ]
            ];


        $topUP = asset('images/topup.png');
        $topUPcontent = [
            'title' => 'Available SIM top up/load',
            'content' => [
                [
                    'text' => "We take pride in offering a comprehensive range of top-up services to cater to all your mobile communication needs. In addition to our primary services, we extend our support to provide various load and top-up options for different mobile SIM cards. If you require assistance with your SIM card load request, we are just a call or message away. Feel free to reach out to us, and our dedicated team will be more than happy to guide you through the process and ensure your mobile connectivity is seamlessly maintained."
                ],
            ]
        ];
        $fbLink = 'https://www.facebook.com/floramae.banas?mibextid=LQQJ4d';
        $mission = [
            'title' => 'Our mission',
            'content' => [
                [
                    'text' => "To help Filipino seafarers and travelers connected to their loveones in an easy and quick service for a very affordable price."
                ],
            ]
        ];
        $vission = [
            'title' => 'Our vision',
            'content' => [
                [
                    'text' => "Our company wants to connect all big and fast internet companies for all seafarers and travelers worldwide."
                ],
            ]
        ];

        $creditedLogo = [
            [
                'imageUrl' => asset('images/logo1.png')
            ],
            [
                'imageUrl' => asset('images/logo2.png')
            ],
            [
                'imageUrl' => asset('images/logo3.png')
            ],
            [
                'imageUrl' => asset('images/logo4.png')
            ],
        ];

        $loadTypes = [
            [
                'name' => 'Amount',
                'value' => 'amount',
            ],
            [
                'name' => 'Plan',
                'value' => 'plan',
            ],
        ];

        $paymentTypes = [
            [
                'name' => 'Credit',
                'value' => 'credit',
            ],
            [
                'name' => 'GCASH',
                'value' => 'gcash',
            ],
            [
                'name' => 'BDO',
                'value' => 'bdo',
            ],
            [
                'name' => 'Bpi',
                'value' => 'bpi',
            ],
        ];

        $banks = [
            'Bdo' => '000161016650',
            'Bpi' => '0429714524',
            'Metrobank' => '1813181377284',
            'Pnb' => '110310085179',
            'Security Bank' => '0000017041371',
            'Unionbank' => '109430949568',
            'Seabank' => '10429718263',
            'Rcbc' => '0000009042219881',
            'Eastwestbank' => '200054314597',
            'Chinabank' => '100302739344',
            'Citibank' => '8670000754',
            'GOtyme bank' => '010507552519',
        ];

        $eWallets = [
            'Gcash 1' => [
                'name' => 'Flora Mae Llanera',
                'number' => '09159966353',
            ],
            'Gcash 2' => [
                'name' => 'Jonathan Llanera Jr',
                'number' => '09106087577',
            ],
            'Gcash 3' => [
                'name' => 'maridel almendras',
                'number' => '09386314151',
            ],
            'Gcash 4' => [
                'name' => 'Jonathan Llanera',
                'number' => '09534271035',
            ],
        ];

        $others = [
            'Coins.ph' => '09159966353',
            'Paymaya' => '09159966353',
            'Grabpay' => '09159966353',
            'Palawan Wallet' => '09159966353',
            'M.lhuiller' => null,
            'Paypal' => null,
            'Cebuana' => null,
            'Western Union' => null,
            'Lbc' => null,
        ];

        $packages = Package::get();
        $amounts = Amount::get();
        $networks = Network::get();

        view()->share([
            'iconData' => $iconData,
            'companyName' => $companyName,
            'navLinks' => $navLinks,
            'footerNavLinks' => $footerNavLinks,
            'iconDataFooter' => $iconDataFooter,
            'missionText' => $missionText,
            'learnMoreText' => $learnMoreText,
            'buyNowText' => $buyNowText,
            'servicess' => $servicess,
            'bannerText' => $bannerText,
            'pruductsHeading' => $pruductsHeading,
            'productSectionDescription' => $productSectionDescription,
            'products' => $products,
            'testimonialHeading' => $testimonialHeading,
            'testimonials' => $testimonials,
            'aboutUsContent1' => $aboutUsContent1,
            'aboutUsImg' => $aboutUsImg,
            'ourBrands' => $ourBrands,
            'aboutUsContent2' => $aboutUsContent2,
            'brands' => $brands,
            'productsList' => $productsList,
            'ourClientHeading' => $ourClientHeading,
            'ourClientHeadingDescription' => $ourClientHeadingDescription,
            'testimonialList2' => $testimonialList2,
            'contactHeading' => $contactHeading,
            'contactHeadingDescription' => $contactHeadingDescription,
            'contactContent1' => $contactContent1,
            'contactUsImg' => $contactUsImg,
            'topUP' => $topUP,
            'topUPcontent' => $topUPcontent,
            'fbLink' => $fbLink,
            'mission' => $mission,
            'vission' => $vission,
            'creditedLogo' => $creditedLogo,
            'networks' =>  $networks,
            'loadTypes' => $loadTypes,
            'paymentTypes' => $paymentTypes,
            'packages' => $packages,
            'amounts' => $amounts,
            'banks' => $banks,
            'eWallets' => $eWallets,
            'others' => $others,
        ]);

    }

}
