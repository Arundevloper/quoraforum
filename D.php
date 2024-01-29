class DecisionTree
{
    private $tree;

    public function __construct($tree)
    {
        $this->tree = $tree;
    }

    public function predict($features)
    {
        $node = $this->tree;
        while ($node['type'] !== 'leaf') {
            $featureValue = $features[$node['feature']];
            $node = $node['children'][$featureValue];
        }
        return $node['prediction'];
    }
}

// Sample dataset with unique IDs
$dataset = [
    [
        'id' => 1,
        'answered_by_professional' => 'yes',
        'likes' => 200,
        'dislikes' => 50,
        'good_answer' => 'yes'
    ],
    [
        'id' => 2,
        'answered_by_professional' => 'no',
        'likes' => 30,
        'dislikes' => 70,
        'good_answer' => 'no'
    ],
    [
        'id' => 3,
        'answered_by_professional' => 'yes',
        'likes' => 150,
        'dislikes' => 30,
        'good_answer' => 'yes'
    ],
    // ... more data entries
];

// Example decision tree structure
$decisionTree = [
    'type' => 'root',
    'feature' => 'answered_by_professional',
    'children' => [
        'yes' => [
            'type' => 'root',
            'feature' => 'like_dislike_ratio',
            'children' => [
                'high' => [
                    'type' => 'leaf',
                    'prediction' => 'This is a good answer'
                ],
                'low' => [
                    'type' => 'leaf',
                    'prediction' => 'This is not a good answer'
                ]
            ]
        ],
        'no' => [
            'type' => 'leaf',
            'prediction' => 'This is not a good answer'
        ]
    ]
];

// Create a decision tree instance
$dt = new DecisionTree($decisionTree);

// Best ID based on factors
$bestID = null;
$bestPrediction = null;

// Iterate over the dataset
foreach ($dataset as $data) {
    $answeredByProfessional = $data['answered_by_professional'];
    $likes = $data['likes'];
    $dislikes = $data['dislikes'];

    $likeDislikeRatio = $likes / $dislikes;

    $features = [
        'answered_by_professional' => $answeredByProfessional,
        'like_dislike_ratio' => $likeDislikeRatio > 1 ? 'high' : 'low'
    ];

    $prediction = $dt->predict($features);

    // Check if the current prediction is better than the previous best prediction
    if ($bestPrediction === null || $prediction === 'This is a good answer') {
        $bestID = $data['id'];
        $bestPrediction = $prediction;
    }
}

// Output the best ID
echo 'Best ID: ' . $bestID . ' with Prediction: ' . $bestPrediction;
