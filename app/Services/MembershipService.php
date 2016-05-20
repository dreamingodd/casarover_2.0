<?php
namespace App\Services;
use Config;

class MembershipService {
    public function upgradeWxMembershipLevelIfNeeded($wxMembership) {
        $level = $wxMembership->level;
        $score = $wxMembership->accumulated_score;
        $levelDetails = Config::get('casarover.wx_membership_detail');
        $nextLevelLeastScore = $levelDetails[$level + 1]['score'];
        // Membership upgrade.
        if ($score >= $nextLevelLeastScore) {
            // Determine which level user will upgrade to.
            for ($i = count($levelDetails) - 1; $i > $level; $i--) {
                $levelDetail = $levelDetails[$i];
                if ($score > $levelDetail['score']) {
                    // Upgrade and save.
                    $wxMembership->level = $levelDetail['level'];
                    $wxMembership->save();
                    break;
                }
            }
        }
    }
}
