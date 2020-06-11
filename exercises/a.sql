--
-- For Postgres
--

DROP TABLE IF EXISTS games CASCADE;
DROP TABLE IF EXISTS teams CASCADE;
DROP TABLE IF EXISTS players CASCADE;

CREATE TABLE IF NOT EXISTS teams
(
    id   UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    name VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS players
(
    id      UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    team_id UUID,
    name    VARCHAR(30) NOT NULL
);

-- Instead of UNIQUE index and UUID primary key we could make
-- a composite primary key:
-- PRIMARY KEY (team_a, team_b, date),
CREATE TABLE IF NOT EXISTS games
(
    id     UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    team_a UUID,
    team_b UUID,
    date   date NOT NULL,

    UNIQUE (team_a, team_b, date),

    CONSTRAINT not_equal CHECK (team_a <> team_b)
);

-- Add indices
CREATE INDEX ON players (team_id);
CREATE INDEX ON games (team_a);
CREATE INDEX ON games (team_b);

-- Add foreign keys
ALTER TABLE players ADD FOREIGN KEY (team_id) REFERENCES teams (id);
ALTER TABLE games ADD FOREIGN KEY (team_a) REFERENCES teams (id);
ALTER TABLE games ADD FOREIGN KEY (team_b) REFERENCES teams (id);
