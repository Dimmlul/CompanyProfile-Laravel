<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $dir = 'articles';

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        // Copy assets
        Storage::disk('public')->put('articles/1.jpeg', File::get(database_path('seeders/assets/articles/1.jpeg')));
        Storage::disk('public')->put('articles/2.jpg', File::get(database_path('seeders/assets/articles/2.jpg')));
        Storage::disk('public')->put('articles/3.webp', File::get(database_path('seeders/assets/articles/3.webp')));
        Storage::disk('public')->put('articles/4.png', File::get(database_path('seeders/assets/articles/4.png')));
        Storage::disk('public')->put('articles/5.png', File::get(database_path('seeders/assets/articles/5.png')));
        Storage::disk('public')->put('articles/6.jpg', File::get(database_path('seeders/assets/articles/6.jpg')));
        Storage::disk('public')->put('articles/7.webp', File::get(database_path('seeders/assets/articles/7.webp')));
        Storage::disk('public')->put('articles/8.png', File::get(database_path('seeders/assets/articles/8.png')));

        /*
        |--------------------------------------------------------------------------
        | ARTICLE 1
        |--------------------------------------------------------------------------
        */
        Article::create([
            'title' => 'The Importance of Digital Presence for Modern Businesses',
            'content' => "In the modern business environment, digital presence has become a basic necessity rather than a competitive advantage. Customers no longer rely solely on physical locations or traditional marketing to discover a brand. Most first interactions now begin online.

A company’s website and digital platforms often create the first impression. If the design feels outdated, the content is unclear, or the experience is slow, trust can be lost instantly. Digital appearance directly influences how professional a business is perceived.

Strong digital presence helps businesses communicate their value clearly. Well-structured pages, clear messaging, and intuitive navigation allow users to quickly understand what a company offers. This clarity reduces friction and encourages engagement.

Consistency across digital channels is essential. When branding, tone, and visuals remain aligned across websites, social media, and campaigns, a business appears reliable. Consistency strengthens brand recognition and long-term credibility.

Digital platforms also remove traditional limitations. Customers can access information at any time without being restricted by location or operating hours. This accessibility improves convenience and expands market reach.

As customer behavior evolves, expectations increase. Mobile responsiveness, fast loading times, and accessibility are no longer optional features. They are fundamental requirements in a competitive digital market.

Digital presence also supports data-driven decision making. Analytics tools allow businesses to track behavior, measure performance, and optimize strategies. These insights lead to continuous improvement.

Ultimately, companies that invest in digital presence position themselves for long-term growth. Visibility, trust, and accessibility online are critical for staying relevant in a digital-first economy.",
            'thumbnail' => 'articles/1.jpeg',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(10),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ARTICLE 2
        |--------------------------------------------------------------------------
        */
        Article::create([
            'title' => 'Why UI/UX Design Impacts User Trust',
            'content' => "User trust is built through experience, and UI/UX design plays a major role in shaping that experience. Every interaction influences how users perceive a product or service. Good design builds confidence, while poor design creates doubt.

When users interact with a digital product, clarity is essential. Interfaces that are easy to understand reduce cognitive load and make users feel comfortable. Confusing layouts or unclear actions quickly lead to frustration.

UX design focuses on usability and flow. Thoughtful user journeys guide visitors naturally toward their goals. This guidance creates a sense of control, which is key to building trust.

UI design reinforces trust visually. Consistent typography, spacing, and color usage signal professionalism. Visual consistency helps users feel that a product is reliable and well maintained.

Small details matter more than many businesses realize. Loading states, error messages, and form feedback all contribute to user perception. Well-handled details demonstrate care and attention.

Trust is often lost faster than it is built. A single broken interaction or confusing flow can push users away permanently. This makes design quality a business-critical factor.

User-centered design also shows respect for the audience. When products are built around real user needs, they feel intuitive and thoughtful. This emotional connection strengthens trust.

In the long term, businesses that prioritize UI/UX design create products users return to. Trust built through experience becomes a strong competitive advantage.",
            'thumbnail' => 'articles/2.jpg',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(12),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ARTICLE 3
        |--------------------------------------------------------------------------
        */
        Article::create([
            'title' => 'Scalable Web Applications for Growing Companies',
            'content' => "Scalability is essential for companies planning long-term growth. Applications built without scalability often struggle as user numbers increase. Performance issues can quickly harm user experience.

A scalable system is designed to handle growth smoothly. It can manage increased traffic, data, and features without major restructuring. This flexibility reduces future risks.

Early architectural decisions have long-lasting impact. Poor decisions can lead to technical debt that slows development. Scalable architecture prevents costly rewrites later.

Performance optimization plays a key role in scalability. Efficient databases, caching strategies, and optimized code ensure systems remain responsive under load.

Scalable applications also support business agility. Teams can release new features faster without breaking existing functionality. This enables faster adaptation to market demands.

Cloud infrastructure has made scalability more accessible. Resources can be adjusted based on real-time needs. This allows companies to grow without excessive upfront costs.

Monitoring and testing are critical for scalable systems. Regular performance testing helps identify bottlenecks before they become serious problems.

Ultimately, scalable web applications allow businesses to grow confidently. Technology becomes an enabler rather than a limitation.",
            'thumbnail' => 'articles/3.webp',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(15),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ARTICLE 4
        |--------------------------------------------------------------------------
        */
        Article::create([
            'title' => 'Choosing the Right Tech Stack for Startups',
            'content' => "For startups, choosing a tech stack is a strategic decision. It affects development speed, scalability, and long-term maintenance. A wrong choice can slow growth significantly.

Startups often need to move quickly. A flexible and modern tech stack allows rapid prototyping and iteration. Speed is critical in early stages.

Performance and reliability should not be sacrificed for speed. The right stack balances fast development with stability. This balance prevents future bottlenecks.

Community support is another important factor. Popular technologies offer better documentation, tools, and talent availability. This reduces long-term risks.

Maintainability matters as teams grow. Clean architecture and familiar technologies make onboarding easier. This improves collaboration and productivity.

Cost considerations also influence decisions. Some stacks require higher infrastructure or maintenance costs. Smart choices help manage limited budgets.

Scalability should be planned from the beginning. A good stack allows startups to grow without major changes. This protects early investments.

Ultimately, the right tech stack supports both short-term execution and long-term vision. Thoughtful decisions lay a strong foundation for success.",
            'thumbnail' => 'articles/4.png',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(18),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ARTICLE 5
        |--------------------------------------------------------------------------
        */
        Article::create([
            'title' => 'How Landing Pages Increase Conversion Rates',
            'content' => "Landing pages are designed with a single goal in mind. Unlike general pages, they focus user attention on one action. This focus increases effectiveness.

Clear messaging is essential for high-converting landing pages. Visitors should immediately understand the value being offered. Ambiguity leads to drop-offs.

Visual hierarchy guides user behavior. Headlines, supporting text, and calls to action must work together. Proper spacing and contrast improve clarity.

Trust signals also play a major role. Testimonials, certifications, and social proof reduce hesitation. These elements reassure users before taking action.

Simplicity improves conversions. Removing unnecessary navigation and distractions keeps users focused. Every element should support the primary goal.

Mobile optimization is critical. Many users access landing pages on mobile devices. Poor mobile experience directly reduces conversion rates.

Testing and optimization are ongoing processes. A/B testing helps identify what works best. Small improvements can produce significant results.

Well-designed landing pages turn traffic into results. They maximize marketing efforts and improve overall campaign performance.",
            'thumbnail' => 'articles/5.png',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(20),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ARTICLE 6
        |--------------------------------------------------------------------------
        */
        Article::create([
            'title' => 'Digital Transformation for SMEs',
            'content' => "Digital transformation helps SMEs remain competitive in modern markets. It is not just about tools, but about changing how businesses operate.

Automation reduces manual workload and errors. Digital systems improve efficiency across departments. This allows teams to focus on higher-value tasks.

Data-driven decision making becomes possible through digital tools. SMEs gain insights into performance and customer behavior. These insights improve strategy.

Customer experience improves through digital channels. Online services, communication, and support increase satisfaction. Convenience becomes a key advantage.

Digital transformation also supports scalability. Businesses can grow without proportionally increasing costs. Systems adapt as demand increases.

Change management is essential during transformation. Teams must be trained and supported. Technology adoption requires cultural alignment.

Security and reliability should not be overlooked. Digital systems must be protected. Trust is critical for customer relationships.

SMEs that embrace digital transformation build resilience. They become more adaptable and future-ready.",
            'thumbnail' => 'articles/6.jpg',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(22),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ARTICLE 7
        |--------------------------------------------------------------------------
        */
        Article::create([
            'title' => 'Security Best Practices in Web Development',
            'content' => "Security is a core requirement in modern web development. Applications handle sensitive data that must be protected. Neglecting security creates serious risks.

Secure authentication is fundamental. Strong password handling and access control prevent unauthorized access. These measures protect user accounts.

Data validation prevents common attacks. Input should always be sanitized and verified. This reduces vulnerabilities like injection attacks.

Regular updates are critical for security. Dependencies and frameworks evolve to fix vulnerabilities. Outdated software increases exposure.

Encryption protects data in transit and storage. Secure connections build user trust. Encryption is a basic expectation.

Monitoring and logging help detect threats early. Proactive detection reduces damage. Security is an ongoing process.

Developers must follow best practices consistently. Security should be part of the development lifecycle. It cannot be an afterthought.

A secure application protects both users and businesses. Trust depends on reliability and protection.",
            'thumbnail' => 'articles/7.webp',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(25),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ARTICLE 8
        |--------------------------------------------------------------------------
        */
        Article::create([
            'title' => 'Future Trends in Digital Product Development',
            'content' => "Digital product development continues to evolve rapidly. Technology shapes how products are designed, built, and experienced.

Automation is becoming more common. Development processes are optimized through tooling and workflows. This improves efficiency and consistency.

Personalization enhances user engagement. Products adapt to individual behavior and preferences. This creates more meaningful experiences.

Artificial intelligence is influencing product capabilities. AI-driven features improve decision-making and automation. Innovation accelerates rapidly.

User expectations continue to rise. Speed, usability, and accessibility are essential. Products must meet higher standards.

Cross-platform experiences are increasingly important. Users expect seamless interaction across devices. Consistency is key.

Teams must remain adaptable. Continuous learning helps teams stay relevant. Flexibility drives innovation.

Businesses that understand future trends build stronger products. Preparation ensures long-term competitiveness.",
            'thumbnail' => 'articles/8.png',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(30),
        ]);
    }
}
