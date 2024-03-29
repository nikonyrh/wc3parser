<?php
/******************************************************************************
Additional conversion functions for
Warcraft III Replay Parser 2.4
(c) 2003-2010 Juliusz 'Julas' Gonera
http://w3rep.sourceforge.net/
e-mail: julas@toya.net.pl
******************************************************************************/

function convert_bool($value) {
	if (!$value)
		return false;
	
	return true;
}

function convert_speed($value) {
	switch ($value) {
		case 0: $value = 'Slow'; break;
		case 1: $value = 'Normal'; break;
		case 2: $value = 'Fast'; break;
	}
	return $value;
}

function convert_visibility($value) {
	switch ($value) {
		case 0: $value = 'Hide Terrain'; break;
		case 1: $value = 'Map Explored'; break;
		case 2: $value = 'Always Visible'; break;
		case 3: $value = 'Default'; break;
	}
	return $value;
}

function convert_observers($value) {
	switch ($value) {
		case 0: $value = 'No Observers'; break;
		case 2: $value = 'Observers on Defeat'; break;
		case 3: $value = 'Full Observers'; break;
		case 4: $value = 'Referees'; break;
	}
	return $value;
}

function convert_game_type($value) {
	switch ($value) {
		case 0x01: $value = 'Ladder 1vs1/FFA'; break;
		case 0x09: $value = 'Custom game'; break;
		case 0x0D: $value = 'Single player/Local game'; break;
		case 0x20: $value = 'Ladder team game (AT/RT)'; break;
		default: $value = 'unknown';
	}
	return $value;
}

function convert_color($value) {
	switch ($value) {
		case 0: $value = 'red'; break;
		case 1: $value = 'blue'; break;
		case 2: $value = 'teal'; break;
		case 3: $value = 'purple'; break;
		case 4: $value = 'yellow'; break;
		case 5: $value = 'orange'; break;
		case 6: $value = 'green'; break;
		case 7: $value = 'pink'; break;
		case 8: $value = 'gray'; break;
		case 9: $value = 'light-blue'; break;
		case 10: $value = 'dark-green'; break;
		case 11: $value = 'brown'; break;
		case 12: $value = 'observer'; break;
	}
	return $value;
}

function convert_race($value) {
	switch ($value) {
		case 'hpea': case 0x01: case 0x41: $value = 'Human'; break;
		case 'opeo': case 0x02: case 0x42: $value = 'Orc'; break;
		case 'ewsp': case 0x04: case 0x44: $value = 'NightElf'; break;
		case 'uaco': case 0x08: case 0x48: $value = 'Undead'; break;
		case 0x20: case 0x60: $value = 'Random'; break;
		default: $value = 0; // do not change this line
	}
	return $value;
}

function convert_ai($value) {
	switch ($value) {
		case 0x00: $value = "Easy"; break;
		case 0x01: $value = "Normal"; break;
		case 0x02: $value = "Insane"; break;
	}
	return $value;
}

function convert_select_mode($value) {
	switch ($value) {
		case 0x00: $value = "Team & race selectable"; break;
		case 0x01: $value = "Team not selectable"; break;
		case 0x03: $value = "Team & race not selectable"; break;
		case 0x04: $value = "Race fixed to random"; break;
		case 0xCC: $value = "Automated Match Making (ladder)"; break;
	}
	return $value;
}

function convert_chat_mode($value, $player='unknown') {
	switch ($value) {
		case 0x00: $value = 'All'; break;
		case 0x01: $value = 'Allies'; break;
		case 0x02: $value = 'Observers'; break;
		case 0xFE: $value = 'The game has been paused by '.$player.'.'; break;
		case 0xFF: $value = 'The game has been resumed by '.$player.'.'; break;
		default: $value -= 2; // this is for private messages
	}
	return $value;
}

function convert_itemid($value) {
	// ignore numeric Item IDs (0x41 - ASCII A, 0x7A - ASCII z)
	if (ord($value{0}) < 0x41 || ord($value{0}) > 0x7A) {
		return 0;
	}
	
	// you can change the names but not the prefixes (h_, u_, a_, etc.)
	// Human
	elseif ($value{0} == 'h') {
		switch ($value) {
			// units
			case 'hfoo': $value = 'u_Footman'; break;
			case 'hkni': $value = 'u_Knight'; break;
			case 'hmpr': $value = 'u_Priest'; break;
			case 'hmtm': $value = 'u_Mortar Team'; break;
			case 'hpea': $value = 'u_Peasant'; break;
			case 'hrif': $value = 'u_Rifleman'; break;
			case 'hsor': $value = 'u_Sorceress'; break;
			case 'hmtt': case 'hrtt': $value = 'u_Siege Engine'; break;
			case 'hgry': $value = 'u_Gryphon Rider'; break;
			case 'hgyr': $value = 'u_Flying Machine'; break;
			case 'hspt': $value = 'u_Spell Breaker'; break;
			case 'hdhw': $value = 'u_Dragonhawk Rider'; break;
			// building upgrades
			case 'hkee': $value = 'b_Keep'; break;
			case 'hcas': $value = 'b_Castle'; break;
			case 'hctw': $value = 'b_Cannon Tower'; break;
			case 'hgtw': $value = 'b_Guard Tower'; break;
			case 'hatw': $value = 'b_Arcane Tower'; break;
		}
	}

	// Night Elf
	else if ($value{0} == 'e') {
		switch ($value) {
			// units
			case 'ebal': $value = 'u_Glaive Thrower'; break;
			case 'echm': $value = 'u_Chimaera'; break;
			case 'edoc': $value = 'u_Druid of the Claw'; break;
			case 'edot': $value = 'u_Druid of the Talon'; break;
			case 'ewsp': $value = 'u_Wisp'; break;
			case 'esen': $value = 'u_Huntress'; break;
			case 'earc': $value = 'u_Archer'; break;
			case 'edry': $value = 'u_Dryad'; break;
			case 'ehip': $value = 'u_Hippogryph'; break;
			case 'emtg': $value = 'u_Mountain Giant'; break;
			case 'efdr': $value = 'u_Faerie Dragon'; break;
			// building upgrades
			case 'etoa': $value = 'b_Tree of Ages'; break;
			case 'etoe': $value = 'b_Tree of Eternity'; break;
		}
	}

	// Orc
	else if ($value{0} == 'o') {
		switch ($value) {
			// units
			case 'ocat': $value = 'u_Demolisher'; break;
			case 'odoc': $value = 'u_Troll Witch Doctor'; break;
			case 'ogru': $value = 'u_Grunt'; break;
			case 'ohun': case 'otbk': $value = 'u_Troll Headhunter/Berserker'; break;
			case 'okod': $value = 'u_Kodo Beast'; break;
			case 'opeo': $value = 'u_Peon'; break;
			case 'orai': $value = 'u_Raider'; break;
			case 'oshm': $value = 'u_Shaman'; break;
			case 'otau': $value = 'u_Tauren'; break;
			case 'owyv': $value = 'u_Wind Rider'; break;
			case 'ospw': case 'ospm': $value = 'u_Spirit Walker'; break;
			case 'otbr': $value = 'u_Troll Batrider'; break;
			// building upgrades
			case 'ofrt': $value = 'b_Fortress'; break;
			case 'ostr': $value = 'b_Stronghold'; break;
		}
	}

	// Undead
	else if ($value{0} == 'u') {
		switch ($value) {
			// units
			case 'uaco': $value = 'u_Acolyte'; break;
			case 'uabo': $value = 'u_Abomination'; break;
			case 'uban': $value = 'u_Banshee'; break;
			case 'ucry': $value = 'u_Crypt Fiend'; break;
			case 'ufro': $value = 'u_Frost Wyrm'; break;
			case 'ugar': $value = 'u_Gargoyle'; break;
			case 'ugho': $value = 'u_Ghoul'; break;
			case 'unec': $value = 'u_Necromancer'; break;
			case 'umtw': $value = 'u_Meatwagon'; break;
			case 'ushd': $value = 'u_Shade'; break;
			case 'uobs': $value = 'u_Obsidian Statue'; break;
			case 'ubsp': $value = 'u_Destroyer'; break;
			// building upgrades
			case 'unp1': $value = 'b_Halls of the Dead'; break;
			case 'unp2': $value = 'b_Black Citadel'; break;
			case 'uzg1': $value = 'b_Spirit Tower'; break;
			case 'uzg2': $value = 'b_Nerubian Tower'; break;
		}
	}

	// Human heroes
	else if ($value{0} == 'H') {
		switch ($value) {
			case 'Hamg': $value = 'h_Archmage'; break;
			case 'Hmkg': $value = 'h_Mountain King'; break;
			case 'Hpal': $value = 'h_Paladin'; break;
			case 'Hblm': $value = 'h_Blood Mage'; break;
		}
	}

	// Night Elf heroes
	else if ($value{0} == 'E') {
		switch ($value) {
			case 'Edem': $value = 'h_Demon Hunter'; break;
			case 'Ekee': $value = 'h_Keeper of the Grove'; break;
			case 'Emoo': $value = 'h_Priestess of the Moon'; break;
			case 'Ewar': $value = 'h_Warden'; break;
		}
	}

	// Orc heroes
	else if ($value{0} == 'O') {
		switch ($value) {
			case 'Obla': $value = 'h_Blademaster'; break;
			case 'Ofar': $value = 'h_Far Seer'; break;
			case 'Otch': $value = 'h_Tauren Chieftain'; break;
			case 'Oshd': $value = 'h_Shadow Hunter'; break;
		}
	}

	// Undead heroes
	else if ($value{0} == 'U') {
		switch ($value) {
			case 'Udea': $value = 'h_Death Knight'; break;
			case 'Udre': $value = 'h_Dreadlord'; break;
			case 'Ulic': $value = 'h_Lich'; break;
			case 'Ucrl': $value = 'h_Crypt Lord'; break;
		}
	}

	// neutral heroes
	else if ($value{0} == 'N') {
		switch ($value) {
			case 'Npbm': $value = 'h_Pandaren Brewmaster'; break;
			case 'Nbrn': $value = 'h_Dark Ranger'; break;
			case 'Nngs': $value = 'h_Naga Sea Witch'; break;
			case 'Nplh': $value = 'h_Pit Lord'; break;
			case 'Nbst': $value = 'h_Beastmaster'; break;
			case 'Ntin': $value = 'h_Goblin Tinker'; break;
			case 'Nfir': $value = 'h_Firelord'; break;
			case 'Nalc': $value = 'h_Goblin Alchemist'; break;
		}
	}

	// hero abilities
	// WARNING: the names of the heroes must be exactly the same as above
	else if ($value{0} == 'A') {
		switch ($value) {
			case 'AHbz': $value = 'a_Archmage:Blizzard'; break;
			case 'AHwe': $value = 'a_Archmage:Summon Water Elemental'; break;
			case 'AHab': $value = 'a_Archmage:Brilliance Aura'; break;
			case 'AHmt': $value = 'a_Archmage:Mass Teleport'; break;
			case 'AHtb': $value = 'a_Mountain King:Storm Bolt'; break;
			case 'AHtc': $value = 'a_Mountain King:Thunder Clap'; break;
			case 'AHbh': $value = 'a_Mountain King:Bash'; break;
			case 'AHav': $value = 'a_Mountain King:Avatar'; break;
			case 'AHhb': $value = 'a_Paladin:Holy Light'; break;
			case 'AHds': $value = 'a_Paladin:Divine Shield'; break;
			case 'AHad': $value = 'a_Paladin:Devotion Aura'; break;
			case 'AHre': $value = 'a_Paladin:Resurrection'; break;
			case 'AHdr': $value = 'a_Blood Mage:Siphon Mana'; break;
			case 'AHfs': $value = 'a_Blood Mage:Flame Strike'; break;
			case 'AHbn': $value = 'a_Blood Mage:Banish'; break;
			case 'AHpx': $value = 'a_Blood Mage:Summon Phoenix'; break;

			case 'AEmb': $value = 'a_Demon Hunter:Mana Burn'; break;
			case 'AEim': $value = 'a_Demon Hunter:Immolation'; break;
			case 'AEev': $value = 'a_Demon Hunter:Evasion'; break;
			case 'AEme': $value = 'a_Demon Hunter:Metamorphosis'; break;
			case 'AEer': $value = 'a_Keeper of the Grove:Entangling Roots'; break;
			case 'AEfn': $value = 'a_Keeper of the Grove:Force of Nature'; break;
			case 'AEah': $value = 'a_Keeper of the Grove:Thorns Aura'; break;
			case 'AEtq': $value = 'a_Keeper of the Grove:Tranquility'; break;
			case 'AEst': $value = 'a_Priestess of the Moon:Scout'; break;
			case 'AHfa': $value = 'a_Priestess of the Moon:Searing Arrows'; break;
			case 'AEar': $value = 'a_Priestess of the Moon:Trueshot Aura'; break;
			case 'AEsf': $value = 'a_Priestess of the Moon:Starfall'; break;
			case 'AEbl': $value = 'a_Warden:Blink'; break;
			case 'AEfk': $value = 'a_Warden:Fan of Knives'; break;
			case 'AEsh': $value = 'a_Warden:Shadow Strike'; break;
			case 'AEsv': $value = 'a_Warden:Spirit of Vengeance'; break;

			case 'AOwk': $value = 'a_Blademaster:Wind Walk'; break;
			case 'AOmi': $value = 'a_Blademaster:Mirror Image'; break;
			case 'AOcr': $value = 'a_Blademaster:Critical Strike'; break;
			case 'AOww': $value = 'a_Blademaster:Bladestorm'; break;
			case 'AOcl': $value = 'a_Far Seer:Chain Lighting'; break;
			case 'AOfs': $value = 'a_Far Seer:Far Sight'; break;
			case 'AOsf': $value = 'a_Far Seer:Feral Spirit'; break;
			case 'AOeq': $value = 'a_Far Seer:Earth Quake'; break;
			case 'AOsh': $value = 'a_Tauren Chieftain:Shockwave'; break;
			case 'AOae': $value = 'a_Tauren Chieftain:Endurance Aura'; break;
			case 'AOws': $value = 'a_Tauren Chieftain:War Stomp'; break;
			case 'AOre': $value = 'a_Tauren Chieftain:Reincarnation'; break;
			case 'AOhw': $value = 'a_Shadow Hunter:Healing Wave'; break;
			case 'AOhx': $value = 'a_Shadow Hunter:Hex'; break;
			case 'AOsw': $value = 'a_Shadow Hunter:Serpent Ward'; break;
			case 'AOvd': $value = 'a_Shadow Hunter:Big Bad Voodoo'; break;

			case 'AUdc': $value = 'a_Death Knight:Death Coil'; break;
			case 'AUdp': $value = 'a_Death Knight:Death Pact'; break;
			case 'AUau': $value = 'a_Death Knight:Unholy Aura'; break;
			case 'AUan': $value = 'a_Death Knight:Animate Dead'; break;
			case 'AUcs': $value = 'a_Dreadlord:Carrion Swarm'; break;
			case 'AUsl': $value = 'a_Dreadlord:Sleep'; break;
			case 'AUav': $value = 'a_Dreadlord:Vampiric Aura'; break;
			case 'AUin': $value = 'a_Dreadlord:Inferno'; break;
			case 'AUfn': $value = 'a_Lich:Frost Nova'; break;
			case 'AUfa': case 'AUfu': $value = 'a_Lich:Frost Armor'; break;
			case 'AUdr': $value = 'a_Lich:Dark Ritual'; break;
			case 'AUdd': $value = 'a_Lich:Death and Decay'; break;
			case 'AUim': $value = 'a_Crypt Lord:Impale'; break;
			case 'AUts': $value = 'a_Crypt Lord:Spiked Carapace'; break;
			case 'AUcb': $value = 'a_Crypt Lord:Carrion Beetles'; break;
			case 'AUls': $value = 'a_Crypt Lord:Locust Swarm'; break;

			case 'ANbf': $value = 'a_Pandaren Brewmaster:Breath of Fire'; break;
			case 'ANdb': $value = 'a_Pandaren Brewmaster:Drunken Brawler'; break;
			case 'ANdh': $value = 'a_Pandaren Brewmaster:Drunken Haze'; break;
			case 'ANef': $value = 'a_Pandaren Brewmaster:Storm Earth and Fire'; break;
			case 'ANdr': $value = 'a_Dark Ranger:Life Drain'; break;
			case 'ANsi': $value = 'a_Dark Ranger:Silence'; break;
			case 'ANba': $value = 'a_Dark Ranger:Black Arrow'; break;
			case 'ANch': $value = 'a_Dark Ranger:Charm'; break;
			case 'ANms': $value = 'a_Naga Sea Witch:Mana Shield'; break;
			case 'ANfa': $value = 'a_Naga Sea Witch:Frost Arrows'; break;
			case 'ANfl': $value = 'a_Naga Sea Witch:Forked Lightning'; break;
			case 'ANto': $value = 'a_Naga Sea Witch:Tornado'; break;
			case 'ANrf': $value = 'a_Pit Lord:Rain of Fire'; break;
			case 'ANca': $value = 'a_Pit Lord:Cleaving Attack'; break;
			case 'ANht': $value = 'a_Pit Lord:Howl of Terror'; break;
			case 'ANdo': $value = 'a_Pit Lord:Doom'; break;
			case 'ANsg': $value = 'a_Beastmaster:Summon Bear'; break;
			case 'ANsq': $value = 'a_Beastmaster:Summon Quilbeast'; break;
			case 'ANsw': $value = 'a_Beastmaster:Summon Hawk'; break;
			case 'ANst': $value = 'a_Beastmaster:Stampede'; break;
			case 'ANeg': $value = 'a_Goblin Tinker:Engineering Upgrade'; break;
			case 'ANcs': case 'ANc1': case 'ANc2': case 'ANc3': $value = 'a_Goblin Tinker:Cluster Rockets'; break;
			case 'ANsy': case 'ANs1': case 'ANs2': case 'ANs3': $value = 'a_Goblin Tinker:Pocket Factory'; break;
			case 'ANrg': case 'ANg1': case 'ANg2': case 'ANg3': $value = 'a_Goblin Tinker:Robo-Goblin'; break;
			case 'ANic': case 'ANia': $value = 'a_Firelord:Incinerate'; break;
			case 'ANso': $value = 'a_Firelord:Soul Burn'; break;
			case 'ANlm': $value = 'a_Firelord:Summon Lava Spawn'; break;
			case 'ANvc': $value = 'a_Firelord:Volcano'; break;
			case 'ANhs': $value = 'a_Goblin Alchemist:Healing Spray'; break;
			case 'ANab': $value = 'a_Goblin Alchemist:Acid Bomb'; break;
			case 'ANcr': $value = 'a_Goblin Alchemist:Chemical Rage'; break;
			case 'ANtm': $value = 'a_Goblin Alchemist:Transmute'; break;
		}
	}

	// neutral units
	else if ($value{0} == 'n') {
		switch ($value) {
			case 'nskm': $value = 'u_Skeletal Marksman'; break;
			case 'nskf': $value = 'u_Burning Archer'; break;
			case 'nws1': $value = 'u_Dragon Hawk'; break;
			case 'nban': $value = 'u_Bandit'; break;
			case 'nrog': $value = 'u_Rogue'; break;
			case 'nenf': $value = 'u_Enforcer'; break;
			case 'nass': $value = 'u_Assassin'; break;
			case 'nbdk': $value = 'u_Black Drake'; break;
			case 'nrdk': $value = 'u_Red Dragon Whelp'; break;
			case 'nbdr': $value = 'u_Black Dragon Whelp'; break;
			case 'nrdr': $value = 'u_Red Drake'; break;
			case 'nbwm': $value = 'u_Black Dragon'; break;
			case 'nrwm': $value = 'u_Red Dragon'; break;
			case 'nadr': $value = 'u_Blue Dragon'; break;
			case 'nadw': $value = 'u_Blue Dragon Whelp'; break;
			case 'nadk': $value = 'u_Blue Drake'; break;
			case 'nbzd': $value = 'u_Bronze Dragon'; break;
			case 'nbzk': $value = 'u_Bronze Drake'; break;
			case 'nbzw': $value = 'u_Bronze Dragon Whelp'; break;
			case 'ngrd': $value = 'u_Green Dragon'; break;
			case 'ngdk': $value = 'u_Green Drake'; break;
			case 'ngrw': $value = 'u_Green Dragon Whelp'; break;
			case 'ncea': $value = 'u_Centaur Archer'; break;
			case 'ncen': $value = 'u_Centaur Outrunner'; break;
			case 'ncer': $value = 'u_Centaur Drudge'; break;
			case 'ndth': $value = 'u_Dark Troll High Priest'; break;
			case 'ndtp': $value = 'u_Dark Troll Shadow Priest'; break;
			case 'ndtb': $value = 'u_Dark Troll Berserker'; break;
			case 'ndtw': $value = 'u_Dark Troll Warlord'; break;
			case 'ndtr': $value = 'u_Dark Troll'; break;
			case 'ndtt': $value = 'u_Dark Troll Trapper'; break;
			case 'nfsh': $value = 'u_Forest Troll High Priest'; break;
			case 'nfsp': $value = 'u_Forest Troll Shadow Priest'; break;
			case 'nftr': $value = 'u_Forest Troll'; break;
			case 'nftb': $value = 'u_Forest Troll Berserker'; break;
			case 'nftt': $value = 'u_Forest Troll Trapper'; break;
			case 'nftk': $value = 'u_Forest Troll Warlord'; break;
			case 'ngrk': $value = 'u_Mud Golem'; break;
			case 'ngir': $value = 'u_Goblin Shredder'; break;
			case 'nfrs': $value = 'u_Furbolg Shaman'; break;
			case 'ngna': $value = 'u_Gnoll Poacher'; break;
			case 'ngns': $value = 'u_Gnoll Assassin'; break;
			case 'ngno': $value = 'u_Gnoll'; break;
			case 'ngnb': $value = 'u_Gnoll Brute'; break;
			case 'ngnw': $value = 'u_Gnoll Warden'; break;
			case 'ngnv': $value = 'u_Gnoll Overseer'; break;
			case 'ngsp': $value = 'u_Goblin Sapper'; break;
			case 'nhrr': $value = 'u_Harpy Rogue'; break;
			case 'nhrw': $value = 'u_Harpy Windwitch'; break;
			case 'nits': $value = 'u_Ice Troll Berserker'; break;
			case 'nitt': $value = 'u_Ice Troll Trapper'; break;
			case 'nkob': $value = 'u_Kobold'; break;
			case 'nkog': $value = 'u_Kobold Geomancer'; break;
			case 'nthl': $value = 'u_Thunder Lizard'; break;
			case 'nmfs': $value = 'u_Murloc Flesheater'; break;
			case 'nmrr': $value = 'u_Murloc Huntsman'; break;
			case 'nowb': $value = 'u_Wildkin'; break;
			case 'nrzm': $value = 'u_Razormane Medicine Man'; break;
			case 'nnwa': $value = 'u_Nerubian Warrior'; break;
			case 'nnwl': $value = 'u_Nerubian Webspinner'; break;
			case 'nogr': $value = 'u_Ogre Warrior'; break;
			case 'nogm': $value = 'u_Ogre Mauler'; break;
			case 'nogl': $value = 'u_Ogre Lord'; break;
			case 'nomg': $value = 'u_Ogre Magi'; break;
			case 'nrvs': $value = 'u_Frost Revenant'; break;
			case 'nslf': $value = 'u_Sludge Flinger'; break;
			case 'nsts': $value = 'u_Satyr Shadowdancer'; break;
			case 'nstl': $value = 'u_Satyr Soulstealer'; break;
			case 'nzep': $value = 'u_Goblin Zeppelin'; break;
			case 'ntrt': $value = 'u_Giant Sea Turtle'; break;
			case 'nlds': $value = 'u_Makrura Deepseer'; break;
			case 'nlsn': $value = 'u_Makrura Snapper'; break;
			case 'nmsn': $value = 'u_Mur\'gul Snarecaster'; break;
			case 'nscb': $value = 'u_Spider Crab Shorecrawler'; break;
			case 'nbot': $value = 'u_Transport Ship'; break;
			case 'nsc2': $value = 'u_Spider Crab Limbripper'; break;
			case 'nsc3': $value = 'u_Spider Crab Behemoth'; break;
			case 'nbdm': $value = 'u_Blue Dragonspawn Meddler'; break;
			case 'nmgw': $value = 'u_Magnataur Warrior'; break;
			case 'nanb': $value = 'u_Barbed Arachnathid'; break;
			case 'nanm': $value = 'u_Barbed Arachnathid'; break;
			case 'nfps': $value = 'u_Polar Furbolg Shaman'; break;
			case 'nmgv': $value = 'u_Magic Vault'; break;
			case 'nitb': $value = 'u_Icy Treasure Box'; break;
			case 'npfl': $value = 'u_Fel Beast'; break;
			case 'ndrd': $value = 'u_Draenei Darkslayer'; break;
			case 'ndrm': $value = 'u_Draenei Disciple'; break;
			case 'nvdw': $value = 'u_Voidwalker'; break;
			case 'nvdg': $value = 'u_Greater Voidwalker'; break;
			case 'nnht': $value = 'u_Nether Dragon Hatchling'; break;
			case 'nndk': $value = 'u_Nether Drake'; break;
			case 'nndr': $value = 'u_Nether Dragon'; break;
		}
	}

	// upgrades
	else if ($value{0} == 'R') {
		switch ($value) {
			case 'Rhss': $value = 'p_Control Magic'; break;
			case 'Rhme': $value = 'p_Swords'; break;
			case 'Rhra': $value = 'p_Gunpowder'; break;
			case 'Rhar': $value = 'p_Plating'; break;
			case 'Rhla': $value = 'p_Armor'; break;
			case 'Rhac': $value = 'p_Masonry'; break;
			case 'Rhgb': $value = 'p_Flying Machine Bombs'; break;
			case 'Rhlh': $value = 'p_Lumber Harvesting'; break;
			case 'Rhde': $value = 'p_Defend'; break;
			case 'Rhan': $value = 'p_Animal War Training'; break;
			case 'Rhpt': $value = 'p_Priest Training'; break;
			case 'Rhst': $value = 'p_Sorceress Training'; break;
			case 'Rhri': $value = 'p_Long Rifles'; break;
			case 'Rhse': $value = 'p_Magic Sentry'; break;
			case 'Rhfl': $value = 'p_Flare'; break;
			case 'Rhhb': $value = 'p_Storm Hammers'; break;
			case 'Rhrt': $value = 'p_Barrage'; break;
			case 'Rhpm': $value = 'p_Backpack'; break;
			case 'Rhfc': $value = 'p_Flak Cannons'; break;
			case 'Rhfs': $value = 'p_Fragmentation Shards'; break;
			case 'Rhcd': $value = 'p_Cloud'; break;

			case 'Resm': $value = 'p_Strength of the Moon'; break;
			case 'Resw': $value = 'p_Strength of the Wild'; break;
			case 'Rema': $value = 'p_Moon Armor'; break;
			case 'Rerh': $value = 'p_Reinforced Hides'; break;
			case 'Reuv': $value = 'p_Ultravision'; break;
			case 'Renb': $value = 'p_Nature\'s Blessing'; break;
			case 'Reib': $value = 'p_Improved Bows'; break;
			case 'Remk': $value = 'p_Marksmanship'; break;
			case 'Resc': $value = 'p_Sentinel'; break;
			case 'Remg': $value = 'p_Upgrade Moon Glaive'; break;
			case 'Redt': $value = 'p_Druid of the Talon Training'; break;
			case 'Redc': $value = 'p_Druid of the Claw Training'; break;
			case 'Resi': $value = 'p_Abolish Magic'; break;
			case 'Reht': $value = 'p_Hippogryph Taming'; break;
			case 'Recb': $value = 'p_Corrosive Breath'; break;
			case 'Repb': $value = 'p_Vorpal Blades'; break;
			case 'Rers': $value = 'p_Resistant Skin'; break;
			case 'Rehs': $value = 'p_Hardened Skin'; break;
			case 'Reeb': $value = 'p_Mark of the Claw'; break;
			case 'Reec': $value = 'p_Mark of the Talon'; break;
			case 'Rews': $value = 'p_Well Spring'; break;
			case 'Repm': $value = 'p_Backpack'; break;
			case 'Roch': $value = 'p_Chaos'; break;

			case 'Rome': $value = 'p_Melee Weapons'; break;
			case 'Rora': $value = 'p_Ranged Weapons'; break;
			case 'Roar': $value = 'p_Armor'; break;
			case 'Rwdm': $value = 'p_War Drums Damage Increase'; break;
			case 'Ropg': $value = 'p_Pillage'; break;
			case 'Robs': $value = 'p_Berserker Strength'; break;
			case 'Rows': $value = 'p_Pulverize'; break;
			case 'Roen': $value = 'p_Ensnare'; break;
			case 'Rovs': $value = 'p_Envenomed Spears'; break;
			case 'Rowd': $value = 'p_Witch Doctor Training'; break;
			case 'Rost': $value = 'p_Shaman Training'; break;
			case 'Rosp': $value = 'p_Spiked Barricades'; break;
			case 'Rotr': $value = 'p_Troll Regeneration'; break;
			case 'Rolf': $value = 'p_Liquid Fire'; break;
			case 'Ropm': $value = 'p_Backpack'; break;
			case 'Rowt': $value = 'p_Spirit Walker Training'; break;
			case 'Robk': $value = 'p_Berserker Upgrade'; break;
			case 'Rorb': $value = 'p_Reinforced Defenses'; break;
			case 'Robf': $value = 'p_Burning Oil'; break;

			case 'Rusp': $value = 'p_Destroyer Form'; break;
			case 'Rume': $value = 'p_Unholy Strength'; break;
			case 'Rura': $value = 'p_Creature Attack'; break;
			case 'Ruar': $value = 'p_Unholy Armor'; break;
			case 'Rucr': $value = 'p_Creature Carapace'; break;
			case 'Ruac': $value = 'p_Cannibalize'; break;
			case 'Rugf': $value = 'p_Ghoul Frenzy'; break;
			case 'Ruwb': $value = 'p_Web'; break;
			case 'Rusf': $value = 'p_Stone Form'; break;
			case 'Rune': $value = 'p_Necromancer Training'; break;
			case 'Ruba': $value = 'p_Banshee Training'; break;
			case 'Rufb': $value = 'p_Freezing Breath'; break;
			case 'Rusl': $value = 'p_Skeletal Longevity'; break;
			case 'Rupc': $value = 'p_Disease Cloud'; break;
			case 'Rusm': $value = 'p_Skeletal Mastery'; break;
			case 'Rubu': $value = 'p_Burrow'; break;
			case 'Ruex': $value = 'p_Exhume Corpses'; break;
			case 'Rupm': $value = 'p_Backpack'; break;
		}
	}

	// items
	if ($value{1} != '_') {
		switch ($value) {
			case 'amrc': $value = 'i_Amulet of Recall'; break;
			case 'ankh': $value = 'i_Ankh of Reincarnation'; break;
			case 'belv': $value = 'i_Boots of Quel\'Thalas +6'; break;
			case 'bgst': $value = 'i_Belt of Giant Strength +6'; break;
			case 'bspd': $value = 'i_Boots of Speed'; break;
			case 'ccmd': $value = 'i_Scepter of Mastery'; break;
			case 'ciri': $value = 'i_Robe of the Magi +6'; break;
			case 'ckng': $value = 'i_Crown of Kings +5'; break;
			case 'clsd': $value = 'i_Cloak of Shadows'; break;
			case 'crys': $value = 'i_Crystal Ball'; break;
			case 'desc': $value = 'i_Kelen\'s Dagger of Escape'; break;
			case 'gemt': $value = 'i_Gem of True Seeing'; break;
			case 'gobm': $value = 'i_Goblin Land Mines'; break;
			case 'gsou': $value = 'i_Soul Gem'; break;
			case 'guvi': $value = 'i_Glyph of Ultravision'; break;
			case 'gfor': $value = 'i_Glyph of Fortification'; break;
			case 'soul': $value = 'i_Soul'; break;
			case 'mdpb': $value = 'i_Medusa Pebble'; break;
			case 'rag1': $value = 'i_Slippers of Agility +3'; break;
			case 'rat3': $value = 'i_Claws of Attack +3'; break;
			case 'rin1': $value = 'i_Mantle of Intelligence +3'; break;
			case 'rde1': $value = 'i_Ring of Protection +2'; break;
			case 'rde2': $value = 'i_Ring of Protection +3'; break;
			case 'rde3': $value = 'i_Ring of Protection +4'; break;
			case 'rhth': $value = 'i_Khadgar\'s Gem of Health'; break;
			case 'rst1': $value = 'i_Gauntlets of Ogre Strength +3'; break;
			case 'ofir': $value = 'i_Orb of Fire'; break;
			case 'ofro': $value = 'i_Orb of Frost'; break;
			case 'olig': $value = 'i_Orb of Lightning'; break;
			case 'oli2': $value = 'i_Orb of Lightning'; break;
			case 'oven': $value = 'i_Orb of Venom'; break;
			case 'odef': $value = 'i_Orb of Darkness'; break;
			case 'ocor': $value = 'i_Orb of Corruption'; break;
			case 'pdiv': $value = 'i_Potion of Divinity'; break;
			case 'phea': $value = 'i_Potion of Healing'; break;
			case 'pghe': $value = 'i_Potion of Greater Healing'; break;
			case 'pinv': $value = 'i_Potion of Invisibility'; break;
			case 'pgin': $value = 'i_Potion of Greater Invisibility'; break;
			case 'pman': $value = 'i_Potion of Mana'; break;
			case 'pgma': $value = 'i_Potion of Greater Mana'; break;
			case 'pnvu': $value = 'i_Potion of Invulnerability'; break;
			case 'pnvl': $value = 'i_Potion of Lesser Invulnerability'; break;
			case 'pres': $value = 'i_Potion of Restoration'; break;
			case 'pspd': $value = 'i_Potion of Speed'; break;
			case 'rlif': $value = 'i_Ring of Regeneration'; break;
			case 'rwiz': $value = 'i_Sobi Mask'; break;
			case 'sfog': $value = 'i_Horn of the Clouds'; break;
			case 'shea': $value = 'i_Scroll of Healing'; break;
			case 'sman': $value = 'i_Scroll of Mana'; break;
			case 'spro': $value = 'i_Scroll of Protection'; break;
			case 'sres': $value = 'i_Scroll of Restoration'; break;
			case 'ssil': $value = 'i_Staff of Silence'; break;
			case 'stwp': $value = 'i_Scroll of Town Portal'; break;
			case 'tels': $value = 'i_Goblin Night Scope'; break;
			case 'tdex': $value = 'i_Tome of Agility'; break;
			case 'texp': $value = 'i_Tome of Experience'; break;
			case 'tint': $value = 'i_Tome of Intelligence'; break;
			case 'tkno': $value = 'i_Tome of Power'; break;
			case 'tstr': $value = 'i_Tome of Strength'; break;
			case 'ward': $value = 'i_Warsong Battle Drums'; break;
			case 'will': $value = 'i_Wand of Illusion'; break;
			case 'wneg': $value = 'i_Wand of Negation'; break;
			case 'rdis': $value = 'i_Rune of Dispel Magic'; break;
			case 'rwat': $value = 'i_Rune of the Watcher'; break;
			case 'fgrd': $value = 'i_Red Drake Egg'; break;
			case 'fgrg': $value = 'i_Stone Token'; break;
			case 'fgdg': $value = 'i_Demonic Figurine'; break;
			case 'fgfh': $value = 'i_Spiked Collar'; break;
			case 'fgsk': $value = 'i_Book of the Dead'; break;
			case 'engs': $value = 'i_Enchanted Gemstone'; break;
			case 'k3m1': $value = 'i_Mooncrystal'; break;
			case 'modt': $value = 'i_Mask of Death'; break;
			case 'sand': $value = 'i_Scroll of Animate Dead'; break;
			case 'srrc': $value = 'i_Scroll of Resurrection'; break;
			case 'sror': $value = 'i_Scroll of the Beast'; break;
			case 'infs': $value = 'i_Inferno Stone'; break;
			case 'shar': $value = 'i_Ice Shard'; break;
			case 'wild': $value = 'i_Amulet of the Wild'; break;
			case 'wswd': $value = 'i_Sentry Wards'; break;
			case 'whwd': $value = 'i_Healing Wards'; break;
			case 'wlsd': $value = 'i_Wand of Lightning Shield'; break;
			case 'wcyc': $value = 'i_Wand of the Wind'; break;
			case 'rnec': $value = 'i_Rod of Necromancy'; break;
			case 'pams': $value = 'i_Anti-magic Potion'; break;
			case 'clfm': $value = 'i_Cloak of Flames'; break;
			case 'evtl': $value = 'i_Talisman of Evasion'; break;
			case 'nspi': $value = 'i_Necklace of Spell Immunity'; break;
			case 'lhst': $value = 'i_The Lion Horn of Stormwind'; break;
			case 'kpin': $value = 'i_Khadgar\'s Pipe of Insight'; break;
			case 'sbch': $value = 'i_Scourge Bone Chimes'; break;
			case 'afac': $value = 'i_Alleria\'s Flute of Accuracy'; break;
			case 'ajen': $value = 'i_Ancient Janggo of Endurance'; break;
			case 'lgdh': $value = 'i_Legion Doom-Horn'; break;
			case 'hcun': $value = 'i_Hood of Cunning'; break;
			case 'mcou': $value = 'i_Medallion of Courage'; break;
			case 'hval': $value = 'i_Helm of Valor'; break;
			case 'cnob': $value = 'i_Circlet of Nobility'; break;
			case 'prvt': $value = 'i_Periapt of Vitality'; break;
			case 'tgxp': $value = 'i_Tome of Greater Experience'; break;
			case 'mnst': $value = 'i_Mana Stone'; break;
			case 'hlst': $value = 'i_Health Stone'; break;
			case 'tpow': $value = 'i_Tome of Knowledge'; break;
			case 'tst2': $value = 'i_Tome of Strength +2'; break;
			case 'tin2': $value = 'i_Tome of Intelligence +2'; break;
			case 'tdx2': $value = 'i_Tome of Agility +2'; break;
			case 'rde0': $value = 'i_Ring of Protection +1'; break;
			case 'rde4': $value = 'i_Ring of Protection +5'; break;
			case 'rat6': $value = 'i_Claws of Attack +6'; break;
			case 'rat9': $value = 'i_Claws of Attack +9'; break;
			case 'ratc': $value = 'i_Claws of Attack +12'; break;
			case 'ratf': $value = 'i_Claws of Attack +15'; break;
			case 'manh': $value = 'i_Manual of Health'; break;
			case 'pmna': $value = 'i_Pendant of Mana'; break;
			case 'penr': $value = 'i_Pendant of Energy'; break;
			case 'gcel': $value = 'i_Gloves of Haste'; break;
			case 'totw': $value = 'i_Talisman of the Wild'; break;
			case 'phlt': $value = 'i_Phat Lewt'; break;
			case 'gopr': $value = 'i_Glyph of Purification'; break;
			case 'ches': $value = 'i_Cheese'; break;
			case 'mlst': $value = 'i_Maul of Strength'; break;
			case 'rnsp': $value = 'i_Ring of Superiority'; break;
			case 'brag': $value = 'i_Bracer of Agility'; break;
			case 'sksh': $value = 'i_Skull Shield'; break;
			case 'vddl': $value = 'i_Voodoo Doll'; break;
			case 'sprn': $value = 'i_Spider Ring'; break;
			case 'tmmt': $value = 'i_Totem of Might'; break;
			case 'anfg': $value = 'i_Ancient Figurine'; break;
			case 'lnrn': $value = 'i_Lion\'s Ring'; break;
			case 'iwbr': $value = 'i_Ironwood Branch'; break;
			case 'jdrn': $value = 'i_Jade Ring'; break;
			case 'drph': $value = 'i_Druid Pouch'; break;
			case 'hslv': $value = 'i_Healing Salve'; break;
			case 'pclr': $value = 'i_Clarity Potion'; break;
			case 'plcl': $value = 'i_Lesser Clarity Potion'; break;
			case 'rej1': $value = 'i_Minor Replenishment Potion'; break;
			case 'rej2': $value = 'i_Lesser Replenishment Potion'; break;
			case 'rej3': $value = 'i_Replenishment Potion'; break;
			case 'rej4': $value = 'i_Greater Replenishment Potion'; break;
			case 'rej5': $value = 'i_Lesser Scroll of Replenishment '; break;
			case 'rej6': $value = 'i_Greater Scroll of Replenishment '; break;
			case 'sreg': $value = 'i_Scroll of Regeneration'; break;
			case 'gold': $value = 'i_Gold Coins'; break;
			case 'lmbr': $value = 'i_Bundle of Lumber'; break;
			case 'fgun': $value = 'i_Flare Gun'; break;
			case 'pomn': $value = 'i_Potion of Omniscience'; break;
			case 'gomn': $value = 'i_Glyph of Omniscience'; break;
			case 'wneu': $value = 'i_Wand of Neutralization'; break;
			case 'silk': $value = 'i_Spider Silk Broach'; break;
			case 'lure': $value = 'i_Monster Lure'; break;
			case 'skul': $value = 'i_Sacrificial Skull'; break;
			case 'moon': $value = 'i_Moonstone'; break;
			case 'brac': $value = 'i_Runed Bracers'; break;
			case 'vamp': $value = 'i_Vampiric Potion'; break;
			case 'woms': $value = 'i_Wand of Mana Stealing'; break;
			case 'tcas': $value = 'i_Tiny Castle'; break;
			case 'tgrh': $value = 'i_Tiny Great Hall'; break;
			case 'tsct': $value = 'i_Ivory Tower'; break;
			case 'wshs': $value = 'i_Wand of Shadowsight'; break;
			case 'tret': $value = 'i_Tome of Retraining'; break;
			case 'sneg': $value = 'i_Staff of Negation'; break;
			case 'stel': $value = 'i_Staff of Teleportation'; break;
			case 'spre': $value = 'i_Staff of Preservation'; break;
			case 'mcri': $value = 'i_Mechanical Critter'; break;
			case 'spsh': $value = 'i_Amulet of Spell Shield'; break;
			case 'sbok': $value = 'i_Spell Book'; break;
			case 'ssan': $value = 'i_Staff of Sanctuary'; break;
			case 'shas': $value = 'i_Scroll of Speed'; break;
			case 'dust': $value = 'i_Dust of Appearance'; break;
			case 'oslo': $value = 'i_Orb of Slow'; break;
			case 'dsum': $value = 'i_Diamond of Summoning'; break;
			case 'sor1': $value = 'i_Shadow Orb +1'; break;
			case 'sor2': $value = 'i_Shadow Orb +2'; break;
			case 'sor3': $value = 'i_Shadow Orb +3'; break;
			case 'sor4': $value = 'i_Shadow Orb +4'; break;
			case 'sor5': $value = 'i_Shadow Orb +5'; break;
			case 'sor6': $value = 'i_Shadow Orb +6'; break;
			case 'sor7': $value = 'i_Shadow Orb +7'; break;
			case 'sor8': $value = 'i_Shadow Orb +8'; break;
			case 'sor9': $value = 'i_Shadow Orb +9'; break;
			case 'sora': $value = 'i_Shadow Orb +10'; break;
			case 'sorf': $value = 'i_Shadow Orb Fragment'; break;
			case 'fwss': $value = 'i_Frost Wyrm Skull Shield'; break;
			case 'ram1': $value = 'i_Ring of the Archmagi'; break;
			case 'ram2': $value = 'i_Ring of the Archmagi'; break;
			case 'ram3': $value = 'i_Ring of the Archmagi'; break;
			case 'ram4': $value = 'i_Ring of the Archmagi'; break;
			case 'shtm': $value = 'i_Shamanic Totem'; break;
			case 'shwd': $value = 'i_Shimmerweed'; break;
			case 'btst': $value = 'i_Battle Standard'; break;
			case 'skrt': $value = 'i_Skeletal Artifact'; break;
			case 'thle': $value = 'i_Thunder Lizard Egg'; break;
			case 'sclp': $value = 'i_Secret Level Powerup'; break;
			case 'gldo': $value = 'i_Orb of Kil\'jaeden'; break;
			case 'tbsm': $value = 'i_Tiny Blacksmith'; break;
			case 'tfar': $value = 'i_Tiny Farm'; break;
			case 'tlum': $value = 'i_Tiny Lumber Mill'; break;
			case 'tbar': $value = 'i_Tiny Barracks'; break;
			case 'tbak': $value = 'i_Tiny Altar of Kings'; break;
			case 'mgtk': $value = 'i_Magic Key Chain'; break;
			case 'stre': $value = 'i_Staff of Reanimation'; break;
			case 'horl': $value = 'i_Sacred Relic'; break;
			case 'hbth': $value = 'i_Helm of Battlethirst'; break;
			case 'blba': $value = 'i_Bladebane Armor'; break;
			case 'rugt': $value = 'i_Runed Gauntlets'; break;
			case 'frhg': $value = 'i_Firehand Gauntlets'; break;
			case 'gvsm': $value = 'i_Gloves of Spell Mastery'; break;
			case 'crdt': $value = 'i_Crown of the Deathlord'; break;
			case 'arsc': $value = 'i_Arcane Scroll'; break;
			case 'scul': $value = 'i_Scroll of the Unholy Legion'; break;
			case 'tmsc': $value = 'i_Tome of Sacrifices'; break;
			case 'dtsb': $value = 'i_Drek\'thar\'s Spellbook'; break;
			case 'grsl': $value = 'i_Grimoire of Souls'; break;
			case 'arsh': $value = 'i_Arcanite Shield'; break;
			case 'shdt': $value = 'i_Shield of the Deathlord'; break;
			case 'shhn': $value = 'i_Shield of Honor'; break;
			case 'shen': $value = 'i_Enchanted Shield'; break;
			case 'thdm': $value = 'i_Thunderlizard Diamond'; break;
			case 'stpg': $value = 'i_Clockwork Penguin'; break;
			case 'shrs': $value = 'i_Shimmerglaze Roast'; break;
			case 'bfhr': $value = 'i_Bloodfeather\'s Heart'; break;
			case 'cosl': $value = 'i_Celestial Orb of Souls'; break;
			case 'shcw': $value = 'i_Shaman Claws'; break;
			case 'srbd': $value = 'i_Searing Blade'; break;
			case 'frgd': $value = 'i_Frostguard'; break;
			case 'envl': $value = 'i_Enchanted Vial'; break;
			case 'rump': $value = 'i_Rusty Mining Pick'; break;
			case 'mort': $value = 'i_Mogrin\'s Report'; break;
			case 'srtl': $value = 'i_Serathil'; break;
			case 'stwa': $value = 'i_Sturdy War Axe'; break;
			case 'klmm': $value = 'i_Killmaim'; break;
			case 'rots': $value = 'i_Scepter of the Sea'; break;
			case 'axas': $value = 'i_Ancestral Staff'; break;
			case 'mnsf': $value = 'i_Mindstaff'; break;
			case 'schl': $value = 'i_Scepter of Healing'; break;
			case 'asbl': $value = 'i_Assassin\'s Blade'; break;
			case 'kgal': $value = 'i_Keg of Ale'; break;
			case 'dphe': $value = 'i_Thunder Phoenix Egg'; break;
			case 'dkfw': $value = 'i_Keg of Thunderwater'; break;
			case 'dthb': $value = 'i_Thunderbloom Bulb'; break;
		}
	}
	return $value;
}

function convert_buildingid($value) {
	// non-ASCII ItemIDs
	if (ord($value{0}) < 0x41 || ord($value{0}) > 0x7A) {
		return 0;
	}
	
	switch ($value) {
		case 'halt': $value = 'Altar of Kings'; break;
		case 'harm': $value = 'Workshop'; break;
		case 'hars': $value = 'Arcane Sanctum'; break;
		case 'hbar': $value = 'Barracks'; break;
		case 'hbla': $value = 'Blacksmith'; break;
		case 'hhou': $value = 'Farm'; break;
		case 'hgra': $value = 'Gryphon Aviary'; break;
		case 'hwtw': $value = 'Scout Tower'; break;
		case 'hvlt': $value = 'Arcane Vault'; break;
		case 'hlum': $value = 'Lumber Mill'; break;
		case 'htow': $value = 'Town Hall'; break;

		case 'etrp': $value = 'Ancient Protector'; break;
		case 'etol': $value = 'Tree of Life'; break;
		case 'edob': $value = 'Hunter\'s Hall'; break;
		case 'eate': $value = 'Altar of Elders'; break;
		case 'eden': $value = 'Ancient of Wonders'; break;
		case 'eaoe': $value = 'Ancient of Lore'; break;
		case 'eaom': $value = 'Ancient of War'; break;
		case 'eaow': $value = 'Ancient of Wind'; break;
		case 'edos': $value = 'Chimaera Roost'; break;
		case 'emow': $value = 'Moon Well'; break;

		case 'oalt': $value = 'Altar of Storms'; break;
		case 'obar': $value = 'Barracks'; break;
		case 'obea': $value = 'Beastiary'; break;
		case 'ofor': $value = 'War Mill'; break;
		case 'ogre': $value = 'Great Hall'; break;
		case 'osld': $value = 'Spirit Lodge'; break;
		case 'otrb': $value = 'Orc Burrow'; break;
		case 'orbr': $value = 'Reinforced Orc Burrow'; break;
		case 'otto': $value = 'Tauren Totem'; break;
		case 'ovln': $value = 'Voodoo Lounge'; break;
		case 'owtw': $value = 'Watch Tower'; break;

		case 'uaod': $value = 'Altar of Darkness'; break;
		case 'unpl': $value = 'Necropolis'; break;
		case 'usep': $value = 'Crypt'; break;
		case 'utod': $value = 'Temple of the Damned'; break;
		case 'utom': $value = 'Tomb of Relics'; break;
		case 'ugol': $value = 'Haunted Gold Mine'; break;
		case 'uzig': $value = 'Ziggurat'; break;
		case 'ubon': $value = 'Boneyard'; break;
		case 'usap': $value = 'Sacrificial Pit'; break;
		case 'uslh': $value = 'Slaughterhouse'; break;
		case 'ugrv': $value = 'Graveyard'; break;

		default: $value = 0;
	}
	return $value;
}

function convert_action($value) {
	switch ($value) {
		case 'rightclick': $value = 'Right click'; break;
		case 'select': $value = 'Select / deselect'; break;
		case 'selecthotkey': $value = 'Select group hotkey'; break;
		case 'assignhotkey': $value = 'Assign group hotkey'; break;
		case 'ability': $value = 'Use ability'; break;
		case 'basic': $value = 'Basic commands'; break;
		case 'buildtrain': $value = 'Build / train'; break;
		case 'buildmenu': $value = 'Enter build submenu'; break;
		case 'heromenu': $value = 'Enter hero\'s abilities submenu'; break;
		case 'subgroup': $value = 'Select subgroup'; break;
		case 'item': $value = 'Give item / drop item'; break;
		case 'removeunit': $value = 'Remove unit from queue'; break;
		case 'esc': $value = 'ESC pressed'; break;
	}
	return $value;
}

function convert_time($value) {
	$output = sprintf('%02d', intval($value/60000)).':';
	$value = $value%60000;
	$output .= sprintf('%02d', intval($value/1000));
	
	return $output;
}

function convert_yesno($value) {
	if (!$value)
		return 'No';
	
	return 'Yes';
}

?>
