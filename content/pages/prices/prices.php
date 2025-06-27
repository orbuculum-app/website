<?php
$plansListInfoIcon = include __DIR__ . '/icons/_plans_list_info_icon.php';

return [
    'include.title' => 'Choose a plan that works for you',
    'include.subtitle' => 'All Pricing Plans',
    'include.items' => [
        [
            'icon' => include __DIR__ . '/icons/prices_unlimited_users.php',
            'title' => 'Unlimited Users',
            'text' => 'Add staff, clients, contractors. No user limits simplify collaboration & mutual settlements.',
        ],
        [
            'icon' => include __DIR__ . '/icons/prices_access_control.php',
            'title' => 'Flexible Permissions',
            'text' => 'Tailor access for staff, clients, & contractors. Ensure everyone sees only what they need.',
        ],
        [
            'icon' => include __DIR__ . '/icons/prices_basic_reports.php',
            'title' => 'Key Financial Reports',
            'text' => 'Instantly access essential P&L, Cash Flow, and Balance Sheet reports for quick insights.',
        ],
        [
            'icon' => include __DIR__ . '/icons/prices_multicurrency.php',
            'title' => 'Multi-Currency Support',
            'text' => 'Manage global finances easily with built-in fiat/crypto support and custom currency options.',
        ],
        [
            'icon' => include __DIR__ . '/icons/prices_project_management.php',
            'title' => 'Project Financial Tracking',
            'text' => 'Link transactions to projects. Easily analyze profitability and track financial performance per project.',
        ],
        [
            'icon' => include __DIR__ . '/icons/prices_action_log.php',
            'title' => 'Action Log (Audit Trail)',
            'text' => 'Maintain full control and transparency with a detailed log of all user actions within the system.',
        ],
        [
            'icon' => include __DIR__ . '/icons/prices_timezone.php',
            'title' => 'Time Zone Support',
            'text' => 'Work seamlessly across regions. Timestamps automatically adjust to each user\'s local time zone.',
        ],
        [
            'icon' => include __DIR__ . '/icons/prices_recurring_transactions.php',
            'title' => 'Recurring Transactions',
            'text' => 'Automate regular payments like salaries or rent. Set them up once, let the system handle repeats.',
        ],
        [
            'icon' => include __DIR__ . '/icons/prices_api_sql.php',
            'title' => 'API & SQL Access',
            'text' => 'Integrate seamlessly. Use API (read/write) & SQL (read-only) for custom reports & dashboards.',
        ]
    ],

    'plans.field_labels' => [
        '__row_1' => '',
        '__row_2' => "Accounts + projects <span class='cursor-pointer roboto tooltip' data-tooltip='Additional Accounts/Projects:
 $ 49 per 100 unit/mo.'><br><span class='tooltip-text roboto'>with pay-as-you-grow expansion options</span>$plansListInfoIcon</span>",
        '__row_3' => 'Transactions',
        '__row_4' => "<span class='cursor-pointer roboto tooltip' data-tooltip='Based on the principle of a bank statement, the balance changes through a list of sequential entries, not by editing old figures.

Important: Every operation, including commissions, is recorded as a separate transaction. Therefore, a transfer with a commission is a minimum of 2 transactions.

All details and examples are in the help section below.
'><span class='tooltip-text roboto'>Transactions</span>$plansListInfoIcon</span><br>included in the plan",
        '__row_5' => 'Cost of additional 1000 transactions',
        '__row_6' => 'Personal manager',
        '__row_7' => "Supported custom integrations <span class='cursor-pointer roboto tooltip' data-tooltip='Additional Managed Integration:
$45 per unit.'><br><span class='tooltip-text roboto'>with pay-as-you-grow expansion options</span>$plansListInfoIcon</span>",
        '__row_8' => "<span class='roboto f-600'>Custom development</span>.<br>Creation/updating of integrations and reports (per quarter, <span class='cursor-pointer roboto tooltip' data-tooltip='Integration or Custom Report Creation/Update: $200 per unit.'><span class='tooltip-text roboto'>with pay-as-you-grow expansion options</span>$plansListInfoIcon</span>)",
        '__row_9' => 'Who it\'s for',
    ],

    'plans.items' => [
        [
            'class' => '_starter',
            'name' => 'Starter',
            'desc' => 'Essential<br>Financial Tools for Beginners',
            'price' => [
                'monthly' => [
                    'value' => '$ 0',
                    'desc' => '<span class="f-s-12 f-500 roboto">Free forever</span>'
                ],
                'yearly' => [
                    'value' => '$ 0',
                    'desc' => '<span class="f-s-12 f-500 roboto">Free forever</span>'
                ],
                'extra_info' => ''
            ],
            'accounts' => [
                'value' => 'up to 40',
                'desc' => ''
            ],
            'transactions' => [
                'value' => 'up to 100',
                'desc' => 'Tracks income from a few clients, bills, and key expenses.'
            ],
            'cost_additional_transactions' => [
                'value' => '',
                'desc' => ''
            ],
            'manager' => [
                'value' => '',
                'desc' => ''
            ],
            'supported_integration' => [
                'value' => '',
                'desc' => ''
            ],
            'integration_updating' => [
                'value' => '',
                'desc' => ''
            ],
            'for_who' => 'Entrepreneurs and freelancers who need free basic financial accounting/bookkeeping'
        ],
        [
            'class' => '_business',
            'name' => 'Business',
            'desc' => 'Full Money Management<br>at Scale',
            'price' => [
                'monthly' => [
                    'value' => '$ 49',
                    'desc' => '<span class="f-s-12 f-500 roboto">Billed monthly</span>'
                ],
                'yearly' => [
                    'value' => '<s>$ 588</s><br>$ 499',
                    'desc' => '<span class="f-s-10_5 f-900 roboto">SAVE UP TO <span class="txt-green">$ 89</span></span>'
                ],
                'extra_info' => ''
            ],
            'accounts' => [
                'value' => '100',
                'desc' => ''
            ],
            'transactions' => [
                'value' => '1000',
                'desc' => 'Processes dozens of weekly sales/orders, supplier payments, and team payroll.'
            ],
            'cost_additional_transactions' => [
                'value' => '$ 35',
                'desc' => ''
            ],
            'manager' => [
                'value' => 'yes',
                'desc' => ''
            ],
            'supported_integration' => [
                'value' => '',
                'desc' => ''
            ],
            'integration_updating' => [
                'value' => '',
                'desc' => ''
            ],
            'for_who' => 'Growing businesses needing advanced features and priority support'
        ],
        [
            'class' => '_growth',
            'name' => 'Growth',
            'desc' => 'Custom-Built Solutions<br>for Integrations and Analytics',
            'price' => [
                'monthly' => [
                    'value' => '$ 149',
                    'desc' => '<span class="f-s-12 f-500 roboto">Billed monthly</span>'
                ],
                'yearly' => [
                    'value' => '<s>$ 1788</s><br>$ 1519',
                    'desc' => '<span class="f-s-10_5 f-900 roboto">SAVE UP TO <span class="txt-green">$ 269</span></span>'
                ],
                'extra_info' => ''
            ],
            'accounts' => [
                'value' => '200',
                'desc' => ''
            ],
            'transactions' => [
                'value' => '5000',
                'desc' => 'Handles hundreds of weekly operations (e.g., e-commerce, SaaS, marketing agency).'
            ],
            'cost_additional_transactions' => [
                'value' => '$ 30',
                'desc' => ''
            ],
            'manager' => [
                'value' => 'yes',
                'desc' => ''
            ],
            'supported_integration' => [
                'value' => '1',
                'desc' => ''
            ],
            'integration_updating' => [
                'value' => 'Up to 3',
                'desc' => ''
            ],
            'for_who' => 'Scaling businesses requiring advanced or custom integrations with CRMs, external reporting, etc.'
        ],
        [
            'class' => '_ultimate',
            'name' => 'Ultimate',
            'desc' => 'Comprehensive Solutions<br>for High-volume Organizations',
            'display_settings' => [
                'price_gap' => [
                    'monthly' => 'gap-7',
                    'yearly' => 'gap-3'
                ]
            ],
            'price' => [
                'monthly' => [
                    'value' => '<s>$ 449</s> $ 0',
                    'desc' => '<span class="f-s-12 f-500 roboto">$0 first 3 month,<br>then&nbsp;$&nbsp;449/month</span>'
                ],
                'yearly' => [
                    'value' => '<s>$ 5388</s> $ 0',
                    'desc' => '<div class="fx-column gap-2"><div class="f-s-12 f-500 roboto">$0 first 3 month,</div><div class="f-s-12 f-500 roboto">then&nbsp;$&nbsp;4579/year</div><div class="f-s-10_5 f-900 roboto mt-7">SAVE UP TO <span class="txt-green">$&nbsp;809</span></div></div>'
                ],
                'extra_info' => '<span class="roboto">30 days before your trial ends, you\'ll get a notification to pick the best plan without overpaying</span>',
            ],
            'accounts' => [
                'value' => '1000',
                'desc' => ''
            ],
            'transactions' => [
                'value' => '10 000',
                'desc' => 'Enables processing thousands of weekly operations, suitable for large structures needing deep accounting and reporting customization.'
            ],
            'cost_additional_transactions' => [
                'value' => '$ 20',
                'desc' => ''
            ],
            'manager' => [
                'value' => 'yes',
                'desc' => ''
            ],
            'supported_integration' => [
                'value' => '6',
                'desc' => ''
            ],
            'integration_updating' => [
                'value' => 'Up to 6',
                'desc' => ''
            ],
            'for_who' => 'Larger enterprises handling high-volume financial data that require elite-level, personalized customization'
        ],
    ],
    'extra_info.image_path' => '/images/prices/prices_extra_info_2.png',
    'extra_info.title' => 'Flexible Expansion Options',
    'extra_info.text' => '<p>Reaching the limits of your plan? 
With any plan, you can easily upgrade its capabilities as your business grows:</p>
  <ul class="fx-column gap-7" style="list-style: none;"> 
    <li style="display: flex; flex-direction: row; align-items: flex-start;"><span style="margin-right: 5px; line-height: 11px;">•</span><div><b>Additional Accounts / Projects:</b> $49 per 100 units.</div></li>
    <li style="display: flex; flex-direction: row; align-items: flex-start;"><span style="margin-right: 5px; line-height: 11px;">•</span><div><b>Additional Managed Integration:</b> $45 per unit.</div></li>
    <li style="display: flex; flex-direction: row; align-items: flex-start;"><span style="margin-right: 5px; line-height: 11px;">•</span><div><b>Integration or Custom Report Creation/Update:</b> $200 per unit. (Custom development based on API/SQL, available in any plan).</div></li>
  </ul>
  <p>Choose the plan that meets your current needs and expand it only when it\'s genuinely necessary and cost-effective.</p>',
    'server.image_path' => '/images/prices/server_img_3.png',
    'server.title' => 'Additional option - dedicated server',
    'server.text' => 'From $ 150 to $ 500+, depending on configuration (memory volume, processor, storage). Available as an addition to any paid tariff plan. Suitable for those who work with large volumes of data or complex analytics, as well as for clients with specific security and compliance requirements. Our specialists will help you choose the optimal server configuration for your tasks.
',

    // FAQ section
    'faq.title' => 'Get more details',
    'faq.items' => [
        [
            'question' => 'Transaction',
            'answer' => '<p>Every financial record – a transfer, commission, or change in debt – is a separate transaction that counts towards your plan\'s limit.<br>One action you take in the interface can generate multiple system transactions, for example:</p>
            <ul class="fx-column gap-7" style="list-style: none;">
                <li style="display: flex; flex-direction: row; align-items: flex-start;"><span style="margin-right: 5px; color: var(--color-list-blue); font-size: 50px; line-height: 11px;">•</span><div>A transfer with a commission = 2 transactions (the transfer itself + the commission charge). Or 3, if a commission is charged on both the recipient\'s and sender\'s side.</div></li>
                <li style="display: flex; flex-direction: row; align-items: flex-start;"><span style="margin-right: 5px; color: var(--color-list-blue); font-size: 50px; line-height: 11px;">•</span><div>A double operation, like invoicing and immediately settling a debt, = 2 transactions.</div></li>
                <li style="display: flex; flex-direction: row; align-items: flex-start;"><span style="margin-right: 5px; color: var(--color-list-blue); font-size: 50px; line-height: 11px;">•</span><div>Including commissions, a double operation can amount to up to 6 transactions (2 transfers, and 2+2 commissions).</div></li>
            </ul>'
        ],
        [
            'question' => 'Accounts + Projects',
            'answer' => '<ul class="fx-column gap-7" style="list-style: none;">
                <li style="display: flex; flex-direction: row; align-items: flex-start;"><span style="margin-right: 5px; color: var(--color-list-blue); font-size: 50px; line-height: 11px;">•</span><div><b>Accounts</b> are any entities involved in transactions: financial accounts, accounts for tracking debts with each contact or employee, and income/expense items (e.g., "Office Rent," "Salaries," "Sales Revenue," "Advertising Expenses"). Accounts are placed within categories, which you can create without limitations.</div></li>
                <li style="display: flex; flex-direction: row; align-items: flex-start;"><span style="margin-right: 5px; color: var(--color-list-blue); font-size: 50px; line-height: 11px;">•</span><div><b>Projects</b> are tags for grouping transactions to analyze P&L and other analytics.</div></li>
            </ul>
            <p><b>Example:</b> 5 financial accounts + 3 contacts (3 accounts) + 15 income/expense items + 2 projects = 25 units for the limit.</p>'
        ],
        [
            'question' => 'Creating/Updating Integrations or Custom Reports',
            'answer' => '<p>Custom development by our team to create or modify integrations with external data sources (e.g., payment systems, banks, CRM) and/or custom reports (e.g., ROI of marketing channels, forecast of card top-up needs, cohort analysis).</p>
            <ul class="fx-column gap-7" style="list-style: none;">
                <li style="display: flex; flex-direction: row; align-items: flex-start;"><span style="margin-right: 5px; color: var(--color-list-blue); font-size: 50px; line-height: 11px;">•</span><div><b>Scope of work:</b> One "unit" is typically one standard report or one integration. The scope for complex tasks and the grouping of minor adjustments are estimated and agreed upon with you individually.</div></li>
                <li style="display: flex; flex-direction: row; align-items: flex-start;"><span style="margin-right: 5px; color: var(--color-list-blue); font-size: 50px; line-height: 11px;">•</span><div><b>Terms:</b> The service limit is calculated quarterly and does not carry over to the next period. The cost of an additional unit beyond the plan is $200.</div></li>
            </ul>'
        ]
    ]

];