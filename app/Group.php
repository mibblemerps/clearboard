<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users()
    {
        return $this->hasMany('App\User', 'group');
    }

    /**
     * Get the parent group
     * @return Group
     */
    public function parent()
    {
        if ($this->inherits == 0) {
            // No parent to this group
            return null;
        }

        return Group::find($this->inherits);
    }

    /**
     * Check if this group has a particular permissino node.
     * *Does* take into account inheritance.
     * @param $node
     * @return bool
     */
    public function hasPermissionNode($node)
    {
        $perms = json_decode($this->perms);
        if (in_array($node, $perms)) {
            // We have permission
            return true;
        } else {
            // Check if inherited group has permission node
            $parent = $this->parent();
            if ($parent !== null) {
                return $parent->hasPermissionNode($node);
            }
        }
    }
}
